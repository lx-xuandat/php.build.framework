<?php
/** @var $exception \Exception */
$exception = $this->exception;
?>

<h1><?= $exception->getCode() ?> - <?= $exception->getMessage() ?></h1>
