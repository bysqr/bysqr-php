<?php


namespace Bysqr;


use BackedEnum;
use ReflectionClass;
use ReflectionProperty;

class Serializer
{
    /**
     * Serialize Pay object to JSON.
     */
    public function serialize(Pay $pay): string
    {
        return json_encode($this->serializeValue($pay));
    }

    /**
     * Serialize given property value.
     */
    protected function serializeValue(mixed $value): mixed
    {
        if ($value instanceof BackedEnum) {
            return $value->value;
        } else if (is_array($value)) {
            return array_map(fn (mixed $val) => $this->serializeValue($val), $value);
        } else if (is_object($value)) {
            $clazz = new ReflectionClass($value);

            $result = [];

            foreach ($clazz->getProperties(ReflectionProperty::IS_PUBLIC) as $property) {
                $propertyValue = $property->getValue($value);

                if (is_null($propertyValue)) {
                    continue;
                }

                $val = $this->serializeValue($propertyValue);
                $name = null;

                $attributes = $property->getAttributes(Property::class);
                if (! empty($attributes)) {
                    /** @var \Bysqr\Property $attrs */
                    $attrs = $attributes[0]->newInstance();
                    if ($wrap = $attrs->wrap) {
                        $val = (object) [
                            $wrap => $val,
                        ];
                    }

                    $name = $attrs->name;
                }

                if (is_null($name)) {
                    $name = $this->studly($property->name);
                }

                $result[$name] = $val;
            }

            return (object) $result;
        }

        return $value;
    }

    /**
     * Convert string value to studly caps case.
     */
    protected function studly(string $value): string
    {
        $words = explode(' ', str_replace(['-', '_'], ' ', $value));

        $studlyWords = array_map(fn ($word) => mb_ucfirst($word), $words);

        return implode($studlyWords);
    }
}
