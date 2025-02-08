using System.Diagnostics;
using System.Text;
using API_Alunos.DBContext;
using API_Alunos.Repositories;
using API_Alunos.Repositories.Interfaces;
using Microsoft.AspNetCore.Authentication.JwtBearer;
using Microsoft.IdentityModel.Tokens;
using Microsoft.OpenApi.Models;

namespace API_Alunos
{
    public class Program
    {
        public static void Main(string[] args)
        {
            var builder = WebApplication.CreateBuilder(args);

            // Add services to the container.

            builder.Services.AddControllers();
            // Learn more about configuring Swagger/OpenAPI at https://aka.ms/aspnetcore/swashbuckle
            builder.Services.AddEndpointsApiExplorer();
            builder.Services.AddSwaggerGen();

            builder.Services.AddTransient<IAlunoRepository, AlunoRepository>();
            
            //JWT
            
            var jwtSettings = builder.Configuration.GetSection("JwtSettings").Get<JwtSettings>();
            var key = Encoding.UTF8.GetBytes(jwtSettings.Secret);
            builder.Services.AddAuthentication(options =>
                    {
                        options.DefaultAuthenticateScheme = JwtBearerDefaults.AuthenticationScheme;
                        options.DefaultChallengeScheme = JwtBearerDefaults.AuthenticationScheme;
                    })
                   .AddJwtBearer(options =>
                    {
                        options.TokenValidationParameters = new TokenValidationParameters
                        {
                            ValidateIssuer = true,
                            ValidateAudience = true,
                            ValidateLifetime = true,
                            ValidateIssuerSigningKey = true,

                            // Correspondência do Issuer e Audience com os valores esperados no Payload
                            ValidIssuer = "API_Alunos",  // O mesmo valor que você colocou no 'iss' no Payload
                            ValidAudience = "laravel",   // O mesmo valor que você colocou no 'aud' no Payload

                            // Chave secreta usada para verificar a assinatura
                            IssuerSigningKey = new SymmetricSecurityKey(Encoding.UTF8.GetBytes("3UQRwY1sg7OmNkrgOL2CMD9h05k09VhTIGMJPBW7V82OD77YwuGxOR894ECRUEvYyDHcw6h5kl2mKIOctwb0zjKgkf3CPDolxttDOMpC8irTSHiavmHO6CfD8EQ6ATum"))
                            
                        };
                    });


            builder.Services.AddSwaggerGen(options => {
                // Definindo a autenticação JWT no Swagger
                options.AddSecurityDefinition("Bearer", new OpenApiSecurityScheme
                {
                    Description = "JWT Authorization header using the Bearer scheme. Example: \"Authorization: Bearer {token}\"",
                    Name = "Authorization",
                    In = ParameterLocation.Header,
                    Type = SecuritySchemeType.ApiKey
                });

                options.AddSecurityRequirement(new OpenApiSecurityRequirement
                {
                    {
                        new OpenApiSecurityScheme
                        {
                            Reference = new OpenApiReference
                            {
                                Type = ReferenceType.SecurityScheme,
                                Id = "Bearer"
                            }
                        },
                        new string[] { }
                    }
                });
            });
            
            
            var app = builder.Build();

            // Configure the HTTP request pipeline.
            if (app.Environment.IsDevelopment())
            {
                app.UseSwagger();
                app.UseSwaggerUI();
            }

            app.UseHttpsRedirection();

            app.UseAuthentication();
            app.UseAuthorization();
            
            app.MapControllers();

            app.Run();
        }
    }
}
