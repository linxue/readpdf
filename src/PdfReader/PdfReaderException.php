<?php

/**
 * package for readpdf
 *
 * @package   ReadPdf
 * 
 * 
 */

namespace ReadPdf\PdfReader;

use ReadPdf\FpdiException;

/**
 * Exception for the pdf reader class
 */
class PdfReaderException extends FpdiException
{
    /**
     * @var int
     */
    const KIDS_EMPTY = 0x0101;

    /**
     * @var int
     */
    const UNEXPECTED_DATA_TYPE = 0x0102;

    /**
     * @var int
     */
    const MISSING_DATA = 0x0103;
}
