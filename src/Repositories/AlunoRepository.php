<?php
namespace App\Doctrine\Repositories;

use App\Doctrine\Entity\Aluno;
use Doctrine\ORM\EntityRepository;

class AlunoRepository extends EntityRepository {

  public function buscarCursosPorAluno () {
    $query = $this->createQueryBuilder('aluno')
         ->join('aluno.telefones','t')
         ->join('aluno.cursos', 'c')
         ->addSelect('t')
         ->addSelect('c')
         ->getQuery();
    return $query->getResult();
  }
}