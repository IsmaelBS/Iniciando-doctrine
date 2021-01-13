<?php
namespace App\Doctrine\Repositories;

use App\Doctrine\Entity\Aluno;
use Doctrine\ORM\EntityRepository;

class AlunoRepository extends EntityRepository {

  public function buscarCursosPorAluno () {
    $className = Aluno::class;
    $dql = "SELECT aluno, telefones, cursos FROM $className as aluno 
                                            JOIN aluno.telefones telefones 
                                            JOIN aluno.cursos cursos";
    /** @var Aluno[] $alunos */
    $alunos= $this->getEntityManager()
                  ->createQuery($dql)
                  ->getResult();
    return $alunos;
  }
}