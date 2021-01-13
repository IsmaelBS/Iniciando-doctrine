<?php
namespace App\Doctrine\Entity;
use App\Doctrine\Entity\Aluno;

/**
 * @Entity
 */
class Telefone {
  /**
   * @Id
   * @Column(type="integer")
   * @GeneratedValue
   */
  private int $id;
  
  /**
   * @Column(type="string")
   */
  private string $numero;

  /**
   * @ManyToOne(targetEntity="Aluno",inversedBy="telefones")
   */
  private Aluno $aluno;

  public function getId(): int {
    return $this->id;
  }

  public function getNumero():string {
    return $this->numero;
  }

  public function setNumero($numero): self {
    $this->numero = $numero;
    return $this;
  }

  public function getAluno():Aluno {
    return $this->aluno;
  }

  public function setAluno(Aluno $aluno): self {
    $this->aluno = $aluno;
    return $this;
  }
}

