using System.ComponentModel.DataAnnotations;

namespace API_Alunos.Model.FormModel {
    public class AlunoLoginFormWDate {
        [Required] public string CPF { get; set; }
        [Required] public DateTime data_nascimento { get; set; }  // A data de nascimento agora substitui a senha
    }
}

