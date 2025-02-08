using API_Alunos.Model;
using Microsoft.EntityFrameworkCore;

public class PGDBContext: DbContext {
	public DbSet<Aluno> Alunos { get; set; }
	
    const string ConnectionString = "Server=mariadb;" +
                                    "Port=3306;" +       // A porta padrão do MariaDB é 3306
                                    "Database=api_alunos_database;" +
                                    "User Id=root;" +    // Altere para o seu usuário do MariaDB
                                    "Password=root87603;";  // Altere para a sua senha

    protected override void OnConfiguring(DbContextOptionsBuilder optionsBuilder)
        => optionsBuilder.UseMySql(ConnectionString, ServerVersion.AutoDetect(ConnectionString));	
}
