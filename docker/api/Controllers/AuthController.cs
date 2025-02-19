using System.IdentityModel.Tokens.Jwt;
using System.Security.Claims;
using System.Text;
using Microsoft.AspNetCore.Mvc;
using Microsoft.IdentityModel.Tokens;

namespace API_Alunos.Controllers;

public class AuthForm {
    public string? Username { get; set; }
    public string? Password { get; set; }
}

[ApiController]
[Route("api/[controller]")]
public class AuthController : ControllerBase
{
	[HttpPost("login")]
	public IActionResult Login([FromBody] AuthForm authform)
	{
		if (authform.Username == "laravel" && authform.Password == "certificado123")
		{
			var token = GenerateJwtToken(authform.Username);
			return Ok(new { token });
		}
		return Unauthorized();
	}

	private string GenerateJwtToken(string username)
	{
		var claims = new[]
		{
			new Claim(JwtRegisteredClaimNames.Sub, username),
			new Claim(JwtRegisteredClaimNames.Jti, Guid.NewGuid().ToString())
		};

		var key = new SymmetricSecurityKey(Encoding.UTF8.GetBytes("3UQRwY1sg7OmNkrgOL2CMD9h05k09VhTIGMJPBW7V82OD77YwuGxOR894ECRUEvYyDHcw6h5kl2mKIOctwb0zjKgkf3CPDolxttDOMpC8irTSHiavmHO6CfD8EQ6ATum"));
		var creds = new SigningCredentials(key, SecurityAlgorithms.HmacSha256);

		var token = new JwtSecurityToken(
			issuer: "API_Alunos",
			audience: "laravel",
			claims: claims,
			expires: DateTime.Now.AddDays(3650),
			signingCredentials: creds);

		return new JwtSecurityTokenHandler().WriteToken(token);
	}
}
