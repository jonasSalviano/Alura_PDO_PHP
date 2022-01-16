<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once 'vendor/autoload.php';

$connection = ConnectionCreator::createConnection();
$studentRepository = new PdoStudentRepository($connection);

$connection->beginTransaction();
try {

    $aStudent = new Student(
        null,
        'Niko',
        new DateTimeImmutable('1989-06-15')
    );
    $studentRepository->save($aStudent);

    $anotherStudent = new Student(
        null,
        'Sasha',
        new DateTimeImmutable('1989-10-06')
    );
    
    $studentRepository->save($anotherStudent);
    $connection->commit();

} catch (\PDOException $e) {
    echo $e->getMessage();
    $connection->rollBack();
}
