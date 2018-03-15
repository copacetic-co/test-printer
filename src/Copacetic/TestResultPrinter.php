<?php
namespace Copacetic;

/**
 * Totally kickass test result printer
 *
 * @version 1.0.0
 * @author Copacetic Media. <copacetic.co>
 */
class TestResultPrinter extends \PHPUnit\TextUI\ResultPrinter
{

    private $headerPrinted = false;

    /**
     * @param $message
     * @param string $color
     * @param bool $linebreak
     */
    private function out($message, $color = '', $linebreak = false)
    {
        echo ($color ? $this->formatWithColor($color, $message) : $message) . ($linebreak ? "\n" : '');
    }

    /**
     * @param \PHPUnit\Framework\Test $test
     */
    public function startTest(\PHPUnit\Framework\Test $test)
    {
        $this->out("'" . $test->getName() . "'...");
    }

    /**
     * @param \PHPUnit\Framework\Test $test
     */
    public function endTest(\PHPUnit\Framework\Test $test)
    {
        if ($test instanceof \PHPUnit\Framework\TestCase) {
            $this->numAssertions += $test->getNumAssertions();
        }
        $this->lastTestFailed = false;

        if (get_class($test) == 'PHPUnit\Framework\TestSuite') {
            $this->out(" SETUP FAIL", 'fg-red', true);
        } elseif ($test->hasFailed()) {
            $this->out(" FAIL", 'fg-red', true);
        } else {
            $numAssertions = ($test instanceof \PHPUnit\Framework\TestCase) ? $test->getNumAssertions() : 1;
            if ($numAssertions > 0) {
                if ($numAssertions == 1) {
                    $this->out(' OK (' . $numAssertions . ' assertion)', 'fg-green', true);
                } else {
                    $this->out(' OK (' . $numAssertions . ' assertions)', 'fg-green', true);
                }
            } else {
                $this->out(' SKIPPED (0 assertions)', 'fg-yellow', true);
            }
        }
    }

    /**
     * @param \PHPUnit\Framework\TestSuite $suite
     */
    public function startTestSuite(\PHPUnit\Framework\TestSuite $suite)
    {
        parent::startTestSuite($suite);

        if (!$this->headerPrinted) {
            $header = "
                        ██████╗ ██╗  ██╗██████╗ ██╗   ██╗███╗   ██╗██╗████████╗
                        ██╔══██╗██║  ██║██╔══██╗██║   ██║████╗  ██║██║╚══██╔══╝
                        ██████╔╝███████║██████╔╝██║   ██║██╔██╗ ██║██║   ██║
                        ██╔═══╝ ██╔══██║██╔═══╝ ██║   ██║██║╚██╗██║██║   ██║
                        ██║     ██║  ██║██║     ╚██████╔╝██║ ╚████║██║   ██║
                        ╚═╝     ╚═╝  ╚═╝╚═╝      ╚═════╝ ╚═╝  ╚═══╝╚═╝   ╚═╝  ";

            $this->out($header, 'fg-red', true);
            $this->out(" - - - - T E S T   A L L   T H E   T H I N G S - - - - ", 'fg-green', true);
            $this->out('', '', true);
            $this->headerPrinted = true;
        }

        if ($suite->getName() != 'PHPUnit') {
            $this->out("Running '" . $suite->getName() . "'\n");
        }
    }

    public function endTestSuite(\PHPUnit\Framework\TestSuite $suite)
    {
        if ($suite->getName() != 'PHPUnit') {
            $this->out($suite->getName() . " completed." . "\n\n");
        }
    }

    /**
     * @param string $progress
     */
    protected function writeProgress($progress)
    {
        // suppress output
    }

    /**
     * called at conclusion of tests
     */
    protected function printHeader()
    {
        parent::printHeader();
    }
}