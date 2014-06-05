<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Helper\Aggregator;

/**
 * Abstract aggregator helper.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class AbstractAggregatorHelper
{
    /**
     * Aggregates values in the previous values.
     *
     * @param array $values         The values.
     * @param array $previousValues The previous values.
     *
     * @return array The aggregated values.
     */
    protected function aggregateValues(array $values, array $previousValues = array())
    {
        foreach ($values as $value) {
            $previousValues = $this->aggregateValue($value, $previousValues);
        }

        return $previousValues;
    }

    /**
     * Aggregates a value in the previous values.
     *
     * @param mixed $value          The value.
     * @param array $previousValues The previous values.
     *
     * @return array The aggregated values.
     */
    protected function aggregateValue($value, array $previousValues = array())
    {
        if (!in_array($value, $previousValues, true)) {
            $previousValues[] = $value;
        }

        return $previousValues;
    }
}
