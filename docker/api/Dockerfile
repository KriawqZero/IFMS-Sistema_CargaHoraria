# Etapa 1: Build
FROM mcr.microsoft.com/dotnet/sdk:8.0 AS build
WORKDIR /app

# Copiar o arquivo de projeto para a pasta de trabalho
COPY ["API_Alunos.csproj", "./"]

# Restaurar as dependências
RUN dotnet restore

# Copiar todo o restante do projeto para o container
COPY . ./

# Publicar a aplicação
RUN dotnet publish -c Release -o out

# Etapa 2: Runtime
FROM mcr.microsoft.com/dotnet/aspnet:8.0
WORKDIR /app
COPY --from=build /app/out ./

# Expor a porta padrão do ASP.NET
EXPOSE 80
EXPOSE 443

# Comando para iniciar a aplicação automaticamente
ENTRYPOINT ["dotnet", "API_Alunos.dll"]

