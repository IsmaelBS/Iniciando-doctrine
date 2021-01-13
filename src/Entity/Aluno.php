<?php
namespace App\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Doctrine\Entity\Curso;

/**
 * @Entity(repositoryClass="App\Doctrine\Repositories\AlunoRepository")
 */
class Aluno {
    
  /**
   * @Id
   * @Column(name="id",type="integer")
   * @GeneratedValue
   */
  private int $id;
  
  /**
   * @Column(type="string", nullable=false)
   */  
  private string $name;

  /**
   * @OneToMany(targetEntity="Telefone", mappedBy="aluno", cascade={"remove","persist"}, fetch="EAGER")
   */
  private Collection $telefones;

  /**
   * @ManyToMany(targetEntity="Curso", mappedBy="alunos")
   */
  private Collection $cursos;

  public function __construct()
  {
    $this->telefones = new ArrayCollection();
    $this->cursos = new ArrayCollection();
  }

  public function getId():int {
    return $this->id;
  }

  public function getName():string {
    return $this->name;
  }

  public function setName(string $name):self {
    $this->name = $name;
    return $this;
  }

  public function getTelefones(): Collection {
    return $this->telefones;
  }
    
  public function setTelefone(Collection $telefones):self {
    $this->telefones = $telefones;
    return $this;
  }

  public function addTelefone(Telefone $telefone):self {
    $this->telefones->add($telefone);
    $telefone->setAluno($this);
    return $this;
  }

  public function getCursos(): Collection {
    return $this->cursos;
  }
    
  public function setCurso(Collection $cursos):self {
    $this->cursos = $cursos;
    return $this;
  }

  public function addCurso(Curso $curso):self {

    if ($this->cursos->contains($curso)) {
      return $this;
    }

    $this->cursos->add($curso);
    $curso->addAluno($this);
    return $this;
  }
}