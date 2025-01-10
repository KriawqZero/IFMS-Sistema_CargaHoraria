@extends('_layouts.master')

@section('body')
    <div class="sm:pl-12 sm:pr-12">
        <section class="bg-white py-12 px-12 rounded-lg shadow-lg">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">A História por Trás do SISCO (Sistema de Gerenciamento de Carga Horária)</h1>

            <p class="text-lg text-gray-600 mb-6">
                O Sistema de Gerenciamento de Carga Horária surgiu como resposta a uma necessidade prática e urgente enfrentada por alunos, professores e coordenadores no IFMS Câmpus Corumbá. O que começou como um desafio simples, logo se transformou em um projeto de impacto para a comunidade acadêmica.
            </p>

            <h2 class="text-2xl font-semibold text-gray-700 mb-3">O Desafio: A Dificuldade de Gerenciar as Atividades Diversificadas</h2>
            <p class="text-lg text-gray-600 mb-4">
                Nos cursos técnicos, os alunos são obrigados a realizar atividades extras, chamadas atividades diversificadas, para complementar a carga horária do curso. A gestão dessas atividades envolve a obtenção de certificados que devem ser validados pelos professores e coordenadores. No entanto, o processo de validação e controle dessas horas apresentava muitos desafios.
            </p>
            <ul class="list-disc pl-6 text-lg text-gray-600 mb-6">
                <li><strong>Falta de centralização:</strong> O envio dos certificados era feito manualmente, gerando atrasos e falta de organização.</li>
                <li><strong>Validação ineficiente:</strong> Professores e coordenadores enfrentavam dificuldades para acompanhar o total de horas e o status dos certificados.</li>
                <li><strong>Falta de transparência:</strong> Alunos não tinham uma visão clara de quantas horas já haviam completado, o que dificultava o planejamento das suas atividades.</li>
            </ul>

            <h2 class="text-2xl font-semibold text-gray-700 mb-3">A Identificação da Solução: Como Tudo Começou</h2>
            <p class="text-lg text-gray-600 mb-4">
                Marcilio Ortiz e Davi Nunes, alunos do quarto semestre do curso Técnico Integrado em Informática do IFMS Câmpus Corumbá, estavam atentos a esses problemas. Durante conversas informais com colegas de classe, perceberam que a dificuldade em gerenciar as atividades diversificadas era uma preocupação recorrente. Foi então que decidiram tomar uma atitude e buscar uma solução para esse desafio.
            </p>

            <h3 class="text-xl font-semibold text-gray-700 mb-3">A Proposta Inicial</h3>
            <p class="text-lg text-gray-600 mb-4">
                A proposta de Marcilio e Davi foi simples, mas inovadora: desenvolver um sistema digital para centralizar o envio de certificados, validar as horas e permitir o acompanhamento do progresso dos alunos. Isso poderia acabar com a dependência de processos manuais, como o envio de planilhas, tornando a gestão mais eficiente e automatizada.
            </p>

            <h3 class="text-xl font-semibold text-gray-700 mb-3">O Papel do Professor Paulo</h3>
            <p class="text-lg text-gray-600 mb-6">
                O apoio do professor Paulo foi fundamental para o sucesso do projeto. Ele não só orientou Marcilio e Davi, mas também contribuiu com seus vastos conhecimentos em tecnologia e gestão de processos. Sem ele, o projeto teria sido apenas uma boa ideia. Com sua orientação, transformou-se em uma solução funcional e prática.
            </p>

            <h2 class="text-2xl font-semibold text-gray-700 mb-3">Desenvolvendo a Solução: Etapas e Ferramentas Utilizadas</h2>
            <p class="text-lg text-gray-600 mb-4">
                O processo de desenvolvimento do sistema foi estruturado e envolveu várias etapas. Abaixo, estão os principais marcos dessa jornada:
            </p>
            <ul class="list-decimal pl-6 text-lg text-gray-600 mb-6">
                <li><strong>Levantamento de Requisitos:</strong> Marcilio e Davi entrevistaram alunos, professores e coordenadores para entender as necessidades do sistema e garantir que todas as funcionalidades fossem atendidas.</li>
                <li><strong>Modelagem e Diagramação:</strong> Os alunos se concentraram em criar modelos formais para o sistema, incluindo diagramas de casos de uso, fluxos de usuário, diagramas de sequência e diagramas de entidade-relacionamento (ER), fundamentais para garantir a organização e eficiência do sistema.</li>
                <li><strong>Escolha das Tecnologias:</strong> Para o backend, foi escolhido o Laravel 11, uma plataforma robusta e segura. O frontend foi desenvolvido com Tailwind CSS para garantir um design moderno e responsivo, fácil de usar para todos os tipos de usuários.</li>
                <li><strong>Banco de Dados:</strong> O banco de dados foi estruturado com MariaDB, garantindo a organização e integridade das informações dos alunos e certificados.</li>
            </ul>

            <h2 class="text-2xl font-semibold text-gray-700 mb-3">O Impacto: Transformando a Realidade do Campus</h2>
            <p class="text-lg text-gray-600 mb-4">
                O sistema desenvolvido por Marcilio e Davi trouxe transformações significativas para o gerenciamento das atividades diversificadas no IFMS Câmpus Corumbá. A solução não apenas resolveu um problema imediato, mas também criou um impacto duradouro para a comunidade acadêmica.
            </p>
            <ul class="list-disc pl-6 text-lg text-gray-600 mb-6">
                <li><strong>Alunos:</strong> Agora, os alunos podem acompanhar em tempo real o total de horas realizadas e o status de cada certificado, simplificando o envio e a validação dos mesmos.</li>
                <li><strong>Professores:</strong> Acompanhar o progresso dos alunos e validar os certificados ficou muito mais fácil, sem a necessidade de planilhas ou processos manuais complicados.</li>
                <li><strong>Coordenadores:</strong> O sistema oferece uma visão clara e organizada das horas dos alunos, permitindo um gerenciamento mais eficiente das atividades diversificadas.</li>
            </ul>

            <h2 class="text-2xl font-semibold text-gray-700 mb-3">A Conquista: Mais do que um Projeto de TCC</h2>
            <p class="text-lg text-gray-600 mb-6">
                O Sistema de Gerenciamento de Carga Horária não foi apenas um projeto de TCC para Marcilio e Davi, mas uma verdadeira solução para a gestão das atividades diversificadas no IFMS. Ao transformar uma necessidade cotidiana em uma ferramenta prática e eficiente, o projeto demonstrou como a colaboração entre alunos, professores e a comunidade acadêmica pode gerar soluções inovadoras e impactantes.
            </p>
            <p class="text-lg text-gray-600 mb-6">
                Para Marcilio e Davi, a experiência de desenvolver o sistema não só os capacitou como desenvolvedores, mas também lhes proporcionou uma valiosa lição sobre o potencial da tecnologia para resolver problemas reais. O SISCO, que começou como um projeto acadêmico, agora é uma ferramenta essencial no campus, melhorando o processo de validação das horas e ajudando a manter a organização das atividades diversificadas para os alunos do IFMS.
            </p>
        </section>
    </div>
@endsection

