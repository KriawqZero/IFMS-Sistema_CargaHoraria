<?php
namespace Database\Factories;

use App\Models\Certificado;
use App\Models\Aluno;
use App\Notifications\AlunoEnviouCertificado;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificadoFactory extends Factory {
    protected $model = Certificado::class;

    function gerarMultiploAleatorio($multiplo, $max) {
        // Garantir que o máximo seja um múltiplo do número desejado
        $maxMultiplo = intdiv($max, $multiplo) * $multiplo;

        // Gerar um número aleatório dentro do intervalo ajustado
        $random = random_int(1, $maxMultiplo / $multiplo);

        // Retornar o número aleatório vezes o múltiplo
        return $random * $multiplo;
    }

    public function definition() {
        $observs = [
            "Curso de Extensão",
            "Evento Científico",
            "Curso de Inglês Técnico",
            "Evento FEAPAN",
            "Evento Halloween",
            "Ajudei no evento X",
            "Ajudei no evento Y",
            "Ajudei no evento Z",
            "Extensão Universitária",
            "Participação em Evento Tal",
            "Curso de Capacitação Profissional",
            "Seminário de Inovação",
            "Palestra sobre Empreendedorismo",
            "Workshop de Marketing Digital",
            "Curso de Fotografia Básica",
            "Seminário de Tecnologia da Informação",
            "Workshop de Desenvolvimento Web",
            "Curso de Design Gráfico",
            "Evento de Networking Empresarial",
            "Curso de Liderança e Gestão",
            "Capacitação em Atendimento ao Cliente",
            "Participação no Evento Internacional de Ciência",
            "Congresso de Educação e Pedagogia",
            "Curso de Programação para Iniciantes",
            "Palestra sobre Inteligência Artificial",
            "Curso de Introdução ao Direito",
            "Certificado de Participação em Workshop de Empoderamento Feminino",
            "Curso de Análise de Dados",
            "Certificado de Participação em Encontro de Startups",
            "Curso de Técnicas de Negociação",
            "Palestra sobre Sustentabilidade e Meio Ambiente",
            "Curso de Excel Avançado",
            "Treinamento em Gestão de Projetos",
            "Curso de Marketing de Conteúdo",
            "Seminário de Psicologia Aplicada",
            "Curso de Redação Profissional",
            "Workshop de Desenvolvimento de Softwares",
            "Curso de Autoajuda e Motivação",
            "Evento de Tecnologia e Inovação",
            "Curso de Inteligência Emocional",
            "Congresso de Gestão Empresarial",
            "Workshop de Gestão de Tempo",
            "Curso de Empreendedorismo Social",
            "Curso de Administração de Empresas",
            "Seminário de Educação Financeira",
            "Evento de Atualização em Medicina",
            "Curso de Educação Digital",
            "Palestra sobre Inteligência Coletiva",
            "Curso de Estratégias de Marketing Digital",
            "Seminário sobre Diversidade no Mercado de Trabalho",
            "Workshop de Apresentações e Pitches",
            "Curso de Contabilidade Básica",
            "Capacitação em Recursos Humanos",
            "Evento de Inclusão Digital",
            "Palestra sobre Empreendedorismo Social",
            "Curso de Introdução à Programação",
            "Workshop de Gestão de Carreira",
            "Curso de Comunicação Interpessoal"
        ];


        $categorias = [
            'Unidades curriculares optativas/eletivas',
            'Projetos de ensino, pesquisa e extensão',
            'Prática profissional integradora',
            'Práticas desportivas',
            'Práticas artístico-culturais',
        ];

        $categorias_status = ['pendente', 'invalido', 'valido'];
        $status = $this->faker->randomElement($categorias_status);
        $carga_horaria = $this->gerarMultiploAleatorio(60, 1800);

        $aluno = Aluno::inRandomOrder()->first();

        return [
            'categoria' => $this->faker->randomElement($categorias),
            'titulo' => $this->faker->randomElement($observs),
            'src' => $this->faker->url(),
            /*'observacao' => $this->faker->randomElement($observs),*/
            'carga_horaria' => $carga_horaria, // Carga horária com múltiplos de 30 minutos
            'status' => $status,
            'data_constante' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'aluno_id' => $aluno->id, // Seleciona um aluno aleatório
        ];
    }

    public function configure() {
        return $this->afterCreating(function (Certificado $certificado) {
            $aluno = Aluno::find($certificado->aluno_id);
            $professor = $aluno->turma->professor;

            $professor->notify(new AlunoEnviouCertificado($aluno, $certificado));
        });
    }
}

