#!/usr/bin/env php
<?php

$autoload = realpath(__DIR__ . '/../../../vendor/autoload.php');

if (!file_exists($autoload)) {
    $message = <<<EOT
You must set up the project dependencies, run the following commands:\n
curl -sS https://getcomposer.org/installer | php\n
php composer.phar install\n
EOT;

    echo str_replace('\\n', PHP_EOL, $message);

    exit(1);
}

require $autoload;

use League\CLImate\CLImate;
use StaticReview\Reporter\Reporter;
use StaticReview\Review\Composer\ComposerLintReview;
use StaticReview\Review\Composer\ComposerSecurityReview;
use StaticReview\Review\General\LineEndingsReview;
use StaticReview\Review\PHP\PhpCodeSnifferReview;
use StaticReview\Review\PHP\PhpLintReview;
use StaticReview\StaticReview;
use StaticReview\VersionControl\GitVersionControl;

$reporter = new Reporter();
$climate  = new CLImate();
$git      = new GitVersionControl();
$review   = new StaticReview($reporter);

// Add any reviews to the StaticReview instance, supports a fluent interface.
$review
    ->addReview(new LineEndingsReview())
    ->addReview(new PhpLintReview())
    ->addReview(new ComposerLintReview())
    ->addReview(new ComposerSecurityReview())
;

$codeSniffer = new PhpCodeSnifferReview();
$codeSniffer->setOption('standard', 'PSR2');
$review->addReview($codeSniffer);

if ($git->getStagedFiles()->count() === 0) {
    $climate
        ->out('')
        ->yellow('[-] Nothing to do.')
        ->white('No files founded in the git staged.')
    ;

    exit(0);
}

// Review the staged files.
$review->files($git->getStagedFiles());

// Check if any matching issues were found.
if ($reporter->hasIssues()) {
    $climate
        ->out('')
        ->out('')
    ;

    foreach ($reporter->getIssues() as $issue) {
        $climate->red($issue);
    }

    $climate
        ->out('')
        ->red('[x] Please fix the errors above.')
    ;
    exit(1);

} else {
    $climate
        ->out('')
        ->green('[+] Very well guy.')
        ->white('No issues detected, the commit will be performed in the next step.')
    ;
    exit(0);
}
