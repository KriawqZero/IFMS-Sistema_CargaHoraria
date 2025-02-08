# Etapa 1: Build
FROM mcr.microsoft.com/dotnet/sdk:6.0 AS build
WORKDIR /app

# Copiar os arquivos do projeto e restaurar as dependências
COPY *.csproj ./
RUN dotnet restore

# Copiar todo o restante e compilar
COPY . ./
RUN dotnet publish -c Release -o out

# Etapa 2: Runtime
FROM mcr.microsoft.com/dotnet/aspnet:6.0
WORKDIR /app
COPY --from=build /app/out ./

# Expor a porta padrão do ASP.NET
EXPOSE 80
EXPOSE 443

# Comando para iniciar a aplicação
ENTRYPOINT ["dotnet", "API_Alunos.dll"]

