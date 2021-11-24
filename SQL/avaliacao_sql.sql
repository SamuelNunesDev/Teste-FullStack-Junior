-- a) Encontre a MATRÍCULA(s) dos alunos com nota em BD12015-1menor que 90.
select matricula from tb_historico_academico 
where nota < 90 and codigo_turma = 'BD12015-1';

-- b) Encontre a MATRÍCULA(s) e calcule a média das notas dos alunos na disciplina de POO2015-1. 
select matricula from tb_historico_academico
where codigo_turma = 'POO2015-1';
select avg(nota) media from tb_historico_academico
where codigo_turma = 'POO2015-1';

-- c) Encontre o CODIGO do professor que ministra a turma WEB2015-1.
select codigo_professor from tb_turma
where codigo_turma = 'WEB2015-1';

-- d) Gere o histórico completo do aluno 2015010106 mostrando MATRICULA,CODIGO DA TURMA, CODIGO DA DISCIPLINA, CODIGO PROFESSOR, FREQUENCIA,NOTA.
select h.matricula, h.codigo_turma, t.codigo_disciplina, t.codigo_professor, h.frequencia, h.nota 
from tb_historico_academico h
join tb_turma t on t.codigo_turma = h.codigo_turma
where h.matricula = 2015010106;