<?php
use App\Doctrine\Entity\Aluno;
use App\Doctrine\Entity\Curso;
use App\Doctrine\Entity\Telefone;
use App\Doctrine\Helper\EntityManagerFactory;
use Doctrine\DBAL\Logging\DebugStack;

require_once __DIR__ . '/../vendor/autoload.php';

$entityManagerFactory = new EntityManagerFactory();
$entityManager = $entityManagerFactory->getEntityManager();

$dql = "SELECT Aluno FROM App\\Doctrine\\Entity\\Aluno as Aluno WHERE Aluno.id = 1";

/** @var Aluno[] $alunos */
$alunos = $entityManager->createQuery($dql)->getResult();

$debugStack = new DebugStack();
$entityManager->getConfiguration()->setSQLLogger($debugStack);

foreach ($alunos as $aluno) {
  $telefones =  $aluno->getTelefones()
                      ->map(function (Telefone $telefone) {
                        return $telefone->getNumero();
                      })
                      ->toArray();
                      
  $cursos = $aluno->getCursos()
                  ->map(function (Curso $curso) {
                    return $curso->getNome();
                  })
                  ->toArray();

  echo "ID :{$aluno->getId()}\nName: {$aluno->getName()}\n" . PHP_EOL;
  echo "Telefones:" . implode(", ", $telefones) . "\n" . PHP_EOL;
  echo "Cursos:\n- " . implode("\n- ", $cursos) . "\n\n";
}

foreach ($debugStack->queries as $queryInfo) {
  echo $queryInfo['sql'] . '\n';
}