@extends('_layouts.master')

@section('body')
    <div class="pl-12 pr-12">
        <section class="bg-white py-10 px-6 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">A História por Trás do SISCO (Sistema de Gerenciamento de Carga Horária)</h1>

            <p class="text-lg text-gray-600 mb-6">
                O Sistema de Gerenciamento de Carga Horária surgiu como resposta a uma necessidade prática e urgente enfrentada por alunos, professores e administradores. Mas, como toda boa ideia, ele nasceu de um problema simples que, aos poucos, foi se tornando um desafio complexo a ser resolvido.
            </p>

            <h2 class="text-2xl font-semibold text-gray-700 mb-3">O Desafio: A Dificuldade de Gerenciar as Atividades Diversificadas</h2>
            <p class="text-lg text-gray-600 mb-4">
                Em muitos cursos técnicos, os alunos são obrigados a realizar atividades extras, conhecidas como atividades diversificadas, para complementar sua carga horária. Essas atividades exigem que os alunos obtenham certificados e que essas horas sejam validadas pelas instituições. Porém, esse processo nem sempre é tão simples quanto parece.
            </p>
            <ul class="list-disc pl-6 text-lg text-gray-600 mb-6">
                <li><strong>Falta de centralização:</strong> Os alunos precisavam enviar seus certificados manualmente para os professores e esperar por validações. Isso gerava atrasos e confusão.</li>
                <li><strong>Validação ineficiente:</strong> Professores e administradores enfrentavam dificuldades para acompanhar as horas dos alunos, e muitos certificados acabavam sendo perdidos ou mal interpretados.</li>
                <li><strong>Falta de transparência:</strong> Alunos não sabiam exatamente quantas horas já haviam completado, o que dificultava o planejamento das atividades.</li>
            </ul>

            <h2 class="text-2xl font-semibold text-gray-700 mb-3">A Identificação da Solução: Como Tudo Começou</h2>
            <p class="text-lg text-gray-600 mb-4">
                Marcilio Ortiz e Davi Nunes, dois estudantes do quarto semestre, estavam atentos a esses problemas. Durante uma conversa informal no campus, perceberam que essa era uma questão recorrente para muitos de seus colegas. Ao discutir o problema com outros alunos e professores, a percepção ficou ainda mais clara: era preciso algo mais do que uma solução improvisada. Era necessário um sistema que unificasse todas as etapas do processo, tornando-o mais eficiente e acessível.
            </p>

            <h3 class="text-xl font-semibold text-gray-700 mb-3">A Proposta Inicial</h3>
            <p class="text-lg text-gray-600 mb-4">
                A ideia foi simples, mas poderosa: criar um sistema digital que centralizasse o envio de certificados, a validação das horas e o acompanhamento do progresso dos alunos. Ao invés de confiar em planilhas e processos manuais, um sistema integrado poderia resolver esses problemas de forma automática.
            </p>

            <h3 class="text-xl font-semibold text-gray-700 mb-3">O Papel do Professor Paulo</h3>
            <p class="text-lg text-gray-600 mb-6">
                O apoio do professor Paulo foi fundamental para o sucesso do projeto. Ele não só orientou Marcilio e Davi, mas também contribuiu com seus vastos conhecimentos em tecnologia e gestão de processos. Sem ele, o projeto teria sido apenas uma boa ideia. Com sua orientação, transformou-se em uma solução funcional e prática.
            </p>

            <h2 class="text-2xl font-semibold text-gray-700 mb-3">Desenvolvendo a Solução: Etapas e Ferramentas Utilizadas</h2>
            <p class="text-lg text-gray-600 mb-4">
                A jornada para a construção do sistema não foi fácil, mas foi gratificante. Cada etapa exigiu dedicação, testes e ajustes. Aqui estão os principais marcos do desenvolvimento:
            </p>
            <ul class="list-decimal pl-6 text-lg text-gray-600 mb-6">
                <li><strong>Levantamento de Requisitos:</strong> Marcilio e Davi realizaram entrevistas com alunos, professores e administradores para entender as necessidades reais do sistema.</li>
                <li><strong>Prototipagem no Figma:</strong> Utilizaram o Figma para criar protótipos e visualizar como seria a interface do sistema, garantindo que fosse simples e acessível.</li>
                <li><strong>Escolha das Tecnologias:</strong> Optaram pelo Laravel 11 para o backend, garantindo robustez e segurança. O frontend foi feito com Tailwind e Bootstrap para criar um design limpo e responsivo.</li>
                <li><strong>Banco de Dados:</strong> A estrutura do banco foi construída com MariaDB, garantindo que os dados dos alunos e certificados fossem armazenados de forma organizada.</li>
                <li><strong>Integração com API Externa:</strong> Para a autenticação dos alunos, uma API externa foi integrada ao sistema, garantindo um login seguro e eficiente.</li>
            </ul>

            <h2 class="text-2xl font-semibold text-gray-700 mb-3">O Impacto: Transformando a Realidade do Campus</h2>
            <p class="text-lg text-gray-600 mb-4">
                Com o sistema em funcionamento, Marcilio e Davi não só resolveram um problema imediato, mas criaram uma ferramenta que transformou a maneira como as atividades diversificadas são gerenciadas no campus. O sistema trouxe benefícios para todos os envolvidos:
            </p>
            <ul class="list-disc pl-6 text-lg text-gray-600 mb-6">
                <li><strong>Alunos:</strong> Agora, os alunos podiam visualizar em tempo real o total de horas realizadas, além de facilitar o envio e a validação dos certificados.</li>
                <li><strong>Professores:</strong> Acompanhamento fácil e rápido das horas e validação dos certificados, sem precisar de planilhas ou processos manuais.</li>
                <li><strong>Administradores:</strong> Visão clara do progresso dos alunos e controle total sobre o gerenciamento das atividades.</li>
            </ul>

            <h2 class="text-2xl font-semibold text-gray-700 mb-3">A Conquista: Mais do que um Projeto de TCC</h2>
            <p class="text-lg text-gray-600 mb-6">
                O Sistema de Gerenciamento de Carga Horária não foi apenas um projeto de TCC de Marcilio e Davi. Ele se tornou uma solução real para um problema cotidiano, que agora beneficia alunos e professores. A experiência de desenvolver o sistema não só os capacitou como desenvolvedores, mas também proporcionou um aprendizado valioso sobre como a tecnologia pode ser usada para resolver problemas do mundo real.
            </p>
            <p class="text-lg text-gray-600 mb-6">
                O projeto também é um exemplo de como a colaboração entre alunos, professores e a comunidade acadêmica pode gerar soluções inovadoras e impactantes. Marcilio e Davi, com a orientação de Paulo, conseguiram transformar uma dificuldade em uma ferramenta eficaz, que continuará ajudando o campus a melhorar a gestão das atividades diversificadas por muitos anos.
            </p>
        </section>
    </div>
@endsection

