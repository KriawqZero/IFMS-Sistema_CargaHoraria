using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace API_Alunos.Model
{
    [Table("alunos")]
    public class Aluno
    {
        public Aluno(string nome, string senha)
        {
            this.nome = nome;
            this.senha = senha;
        }
        [Key]
        public int id {  get; private set; }
        public string nome { get; private set; }
        public string CPF { get; private set; }
        public DateTime data_nascimento { get; private set; }
        public string senha {  get; private set; }
        public string? email { get; private set; }

    }
}
