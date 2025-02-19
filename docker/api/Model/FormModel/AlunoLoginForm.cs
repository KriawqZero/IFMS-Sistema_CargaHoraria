using System.ComponentModel.DataAnnotations;

namespace API_Alunos.Model.FormModel;

public class AlunoLoginForm {
	[Required] public string usuario { get; set; }
	[Required] public string senha { get; set; }
}
