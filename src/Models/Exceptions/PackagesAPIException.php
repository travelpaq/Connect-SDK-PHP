<?php
/**
 * TravelPAQ Connect Api 
 *
 * @package  TravelPAQ
 * 
 * @author   TravelPAQ <malves@travelpaq.com.ar>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace TravelPAQ\PackagesAPI\Models\Exceptions;

    abstract class PackagesAPIException extends \Exception implements IException
    {
        protected $message = 'Unknown exception';     // Exception message
        private   $string;                            // Unknown
        protected $code    = 0;                       // User-defined exception code
        protected $file;                              // Source filename of exception
        protected $line;                              // Source line of exception
        private   $trace;                             // Unknown

        public function __construct($message = null, $code = 0)
        {
            if (!$message) {
                throw new $this('Unknown '. get_class($this));
            }
            parent::__construct($message, $code, null);
        }
        
        public function __toString()
        {
            return get_class($this) . " '{$this->message}' in {$this->file}({$this->line})\n"
                                    . "{$this->getTraceAsString()}";
        }
    }
?>