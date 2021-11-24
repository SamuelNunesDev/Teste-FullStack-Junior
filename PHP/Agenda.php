<?php
  require_once __DIR__ . '/AgendaInterface.php';
  require_once __DIR__ . '/Evento.php';

  /*
    Classe que abstrai uma agenda; consiste de uma composição simples de eventos.
    Implemente o método privado para filtrar os eventos por dia e o método da AgendaInterface
    para gerar o json ordenado.
  */

  class Agenda implements AgendaInterface{

    private $eventos = [];
    public function __construct($eventos){
      $this->eventos = $eventos;
    }

    // TODO implementar o método "imprimirJsonEventosDiaOrdenados" da AgendaInterface
    // o faça utilizar o método privado filtrarEventosDia que você implementou para
    // obter os eventos do dia; para ordená los use a função nativa usort https://www.php.net/manual/en/function.usort
    // com uma closure para comparação; retorne uma string json com um array de
    // eventos formatados pelo método getEstadoEmArrayAssociativo na classe Evento

    public function imprimirJsonEventosDiaOrdenados($dataHoraDia) {
      $eventosDoDia = $this->filtrarEventosDia($dataHoraDia);
      $eventosDoDia = $this->ordernarEventosDia($eventosDoDia);
      $eventosDoDia = $this->transformarEventosJSON($eventosDoDia);

      return $eventosDoDia;
    }

    private function filtrarEventosDia($dataHoraDia){
      // TODO implementar o método que filtrará os eventos do estado da Agenda,
      // retornando apenas os da data informada por parâmetro - sem alterar o estado
      // do objeto Agenda
      
      $eventosDia = array_filter($this->eventos, function($evento) use($dataHoraDia) {
        return strtotime($evento->getDataHora()->format('Y-m-d')) === strtotime($dataHoraDia);
      });

      return $eventosDia;
    }

    /**
     * Orderna e retorna os eventos do dia por ordem cronológica
     * 
     * @param array $eventosDoDia
     * @return  array $eventosDoDia
     */
    private function ordernarEventosDia($eventosDoDia) {
        usort($eventosDoDia, function($a, $b) {
        $a = strtotime($a->getDataHora()->format('Y-m-d H:i:s'));
        $b = strtotime($b->getDataHora()->format('Y-m-d H:i:s'));
        if ($a == $b) return 0;
        return ($a < $b) ? -1 : 1;
      });

      return $eventosDoDia;
    }

    /**
     * Transforma os (objetos) eventos em array associativo
     * 
     * @param array $eventosDoDia
     * @return  array $eventosDoDia
     */
    private function transformarEventosJSON($eventosDoDia) {
      $eventosDoDia = array_map(function($evento) {
        return $evento->getEstadoEmArrayAssociativo();
      }, $eventosDoDia);

      return json_encode($eventosDoDia);
    }
  }
?>
