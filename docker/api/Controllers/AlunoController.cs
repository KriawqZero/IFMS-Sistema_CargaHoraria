using API_Alunos.Model;
using API_Alunos.Model.FormModel;
using API_Alunos.Repositories.Interfaces;
using Microsoft.AspNetCore.Authorization;
using Microsoft.AspNetCore.Mvc;

namespace API_Alunos.Controllers;

[ApiController]
[Route("api/")]
[Authorize]
public class AlunoController : ControllerBase {
	private readonly IAlunoRepository _repository;
	public AlunoController(IAlunoRepository repository) {
		_repository = repository ?? throw new ArgumentNullException(nameof(repository));
	}

	[HttpPost]
	public IActionResult Add(AlunoForm form) {
		var aluno = new Aluno(form.nome, form.senha);

		_repository.Add(aluno);

		return Ok();
	}

	[HttpPost("login")]
	public IActionResult GetByCpf([FromForm] AlunoLoginForm form) {
		object aluno = _repository.GetAlunoByCPF(form);

		return Ok(aluno);
	}

    [HttpGet("login/data")]
    public IActionResult GetByCpfWDate([FromQuery] AlunoLoginFormWDate form) {
        object aluno = _repository.GetAlunoByCPFWDate(form);

        return Ok(aluno);
    }


	[HttpGet]
    [Route("getAll")]
	public IActionResult Get() {
	    List<Aluno> alunos = _repository.GetAll();

	 	return Ok(alunos);
	}
}
