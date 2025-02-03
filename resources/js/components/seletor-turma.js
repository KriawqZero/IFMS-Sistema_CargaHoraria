document.addEventListener('alpine:init', () => {
    Alpine.data('seletorTurma', (config) => ({
        // Configurações padrão
        maxTurmas: config.maxTurmas || 3,
        turmas: config.turmas || [],
        mensagens: {
            turmaOcupada: 'Esta turma já está alocada ao professor',
            maximoAtingido: 'Você já selecionou o máximo de turmas permitido.',
            ...config.mensagens
        },

        // Estado do componente
        termoPesquisa: '',
        turmasSelecionadas: config.turmasSelecionadas || [],

        // Computed
        turmasFiltradas() {
            const termo = this.removerAcentos(this.termoPesquisa.toLowerCase());
            return this.turmas.filter(turma => {
                const texto = this.removerAcentos(turma.textoBusca.toLowerCase());
                return texto.includes(termo) &&
                    !this.turmasSelecionadas.find(t => t.id === turma.id);
            });
        },

        // Métodos
        clicarTurma(turma) {
            if (this.turmasSelecionadas.length < this.maxTurmas && !turma.professorAtual) {
                this.turmasSelecionadas.push(turma);
                this.termoPesquisa = '';
            } else if (turma.professorAtual) {
                alert(`${this.mensagens.turmaOcupada} ${turma.professorAtual}`);
            } else {
                alert(this.mensagens.maximoAtingido);
            }
        },

        removerAcentos(texto) {
            return texto.normalize('NFD').replace(/[̀-ͯ]/g, '');
        },

        textoTurma(turma) {
            return `${turma.codigo} (${turma.qtdAlunos})`;
        }
    }));
});
