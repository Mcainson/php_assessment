<?php
function printDataStructure(
    array $nestedArray,
    int $indentationLevel = 0
): void {
    foreach ($nestedArray as $nestedItem) {
        foreach ($nestedItem as $propertyName => $propertyValue) {
            $indentation = str_repeat('  ', $indentationLevel);

            if (is_array($propertyValue)) {
                echo "{$indentation}{$propertyName}:\n";
                if (!empty($propertyValue)) {
                    foreach ($propertyValue as $childItem) {
                        printDataStructure(
                            nestedArray: [$childItem],
                            indentationLevel: $indentationLevel + 1
                        );
                        echo "\n";
                    }
                }
            } else {
                echo "{$indentation}{$propertyName}: {$propertyValue}\n";
            }
        }
    }
}
