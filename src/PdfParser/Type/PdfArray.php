<?php

/**
 * package for readpdf
 *
 * @package   ReadPdf
 * 
 * 
 */

namespace ReadPdf\PdfParser\Type;

use ReadPdf\PdfParser\PdfParser;
use ReadPdf\PdfParser\Tokenizer;

/**
 * Class representing a PDF array object
 *
 * @property array $value The value of the PDF type.
 */
class PdfArray extends PdfType
{
    /**
     * Parses an array of the passed tokenizer and parser.
     *
     * @param Tokenizer $tokenizer
     * @param PdfParser $parser
     * @return bool|self
     * @throws PdfTypeException
     */
    public static function parse(Tokenizer $tokenizer, PdfParser $parser)
    {
        $result = [];

        // Recurse into this function until we reach the end of the array.
        while (($token = $tokenizer->getNextToken()) !== ']') {
            if ($token === false || ($value = $parser->readValue($token)) === false) {
                return false;
            }

            $result[] = $value;
        }

        $v = new self();
        $v->value = $result;

        return $v;
    }

    /**
     * Helper method to create an instance.
     *
     * @param PdfType[] $values
     * @return self
     */
    public static function create(array $values = [])
    {
        $v = new self();
        $v->value = $values;

        return $v;
    }

    /**
     * Ensures that the passed array is a PdfArray instance with a (optional) specific size.
     *
     * @param mixed $array
     * @param null|int $size
     * @return self
     * @throws PdfTypeException
     */
    public static function ensure($array, $size = null)
    {
        $result = PdfType::ensureType(self::class, $array, 'Array value expected.');

        if ($size !== null && \count($array->value) !== $size) {
            throw new PdfTypeException(
                \sprintf('Array with %s entries expected.', $size),
                PdfTypeException::INVALID_DATA_SIZE
            );
        }

        return $result;
    }
}
