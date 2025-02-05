<?php

function sortData(array $dataset, array $sortingCriteria): array {
    foreach ($dataset as &$record) {
        foreach ($record as $fieldName => $fieldValue) {
            if (is_array($fieldValue)) {
                $record[$fieldName] = sortData($fieldValue, $sortingCriteria);
            }
        }
    }

    usort($dataset, function ($firstRecord, $secondRecord) use ($sortingCriteria) {
        foreach ($sortingCriteria as $criteria) {
            $firstValue = findValue($firstRecord, $criteria);
            $secondValue = findValue($secondRecord, $criteria);

            if ($firstValue !== $secondValue) {
                return $firstValue <=> $secondValue;
            }
        }
        return 0;
    });

    return $dataset;
}

function findValue(array $record, string $fieldName) {
    if (isset($record[$fieldName])) {
        return $record[$fieldName];
    }

    foreach ($record as $nestedField) {
        if (is_array($nestedField)) {
            if ($foundValue = findValue($nestedField, $fieldName)) {
                return $foundValue;
            }
        }
    }

    return null;
}