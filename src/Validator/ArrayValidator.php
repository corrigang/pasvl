<?php
/**
 * @author Dmitriy Lezhnev <lezhnev.work@gmail.com>
 * Date: 02/01/2018
 */

namespace PASVL\Validator;


class ArrayValidator extends Validator
{
    public function __invoke($data, $nullable = false): bool
    {
        parent::__invoke($data, $nullable);
        return is_iterable($data) ||
            ($nullable && $data == null);
    }

    public function count($data, $count): bool
    {
        return $this->isNullable($data) || count($data) == $count;
    }

    public function keys($data, ...$keys): bool
    {
        if ($this->isNullable($data)) {
            return true;
        }
        
        foreach ($data as $key => $value) {
            if (!in_array($key, $keys)) {
                return false;
            }
        }

        return true;
    }

}
