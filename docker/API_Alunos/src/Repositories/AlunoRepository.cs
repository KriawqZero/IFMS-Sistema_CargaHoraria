using API_Alunos.Model;
using API_Alunos.Model.FormModel;
using API_Alunos.Repositories.Interfaces;

namespace API_Alunos.Repositories;

public class AlunoRepository: IAlunoRepository {
	private readonly PGDBContext _context = new PGDBContext();
	
	public void Add(Aluno aluno) {
		_context.Alunos.Add(aluno);
		_context.SaveChanges();
	}

    public object GetAlunoByCPF(AlunoLoginForm _form) {
        var aluno = _context.Alunos.FirstOrDefault(a => 
                a.CPF == _form.CPF &&
                a.senha == _form.senha);
        
        if(aluno == null) return new {
	        valido = false
        };

        return new {
            aluno.nome,
            aluno.CPF,
            aluno.email,
            aluno.data_nascimento,
            valido = true
        };
    }

	public List<Aluno> GetAll() {
		List<Aluno> alunos = _context.Alunos.ToList();
		
		return alunos;
	}
}
