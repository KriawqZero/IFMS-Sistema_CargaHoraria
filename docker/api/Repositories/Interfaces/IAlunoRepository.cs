using API_Alunos.Model;
using API_Alunos.Model.FormModel;

namespace API_Alunos.Repositories.Interfaces;

public interface IAlunoRepository {
	void Add(Aluno aluno);
    object? GetAlunoByCPF(AlunoLoginForm _form);
    object? GetAlunoByCPFWDate(AlunoLoginFormWDate _form);
	List<Aluno> GetAll();
}
