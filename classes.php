<?php
// (C) 2012 labaka.ru - обучение программированию.

/**
 * Реализация игры "крестики-нолики" на поле произвольного размера.
 * Вариант "ничья" никак не обрабатывается.
 */
class TicTacGame {
    sadtfasdgserdfgvfdzgv
    sadtfasdgserdfgvfdzgvadfgv
    dfzcxgbv
    szdcxh
    bvsdzfcx
    bv dfzcxgbvcg
    /*
     * Размер игрового поля
     */
    private $fieldWidth = 3;
    private $fieldHeight = 3;
    
    /**
     * @var число крестиков или ноликов в ряд для победы.
     */
    private $countToWin = 3;
    
    /**
     * @var массив сделанных ходов вида $field[$x][$y] = $player;
     */
    private $field = array();
    
    /**
     * @var $winnerCells аналогичен $field, но хранит только клетки, которые
     * надо выделить при отображении победившей комбинации.
     */
    private $winnerCells = array();
    
    private $currentPlayer = 1; // 1 или 2, а после окончания игры - null.
    private $winner = null; // после окончания игры будет содержать 1 или 2.
    


    //alex
    private $currentGame = 0; // 1 или 2 или 3
    
     private   $xa=false;
     private   $ya=false;


    public function SetType($type) {
    $this->currentGame=$type;
    }
       /**
     * Обрабатывает очередной ход. Ставит в указанные координаты на поле
     * символ текущего игрока. Передаёт ход другому игроку, а в случае победы
     * опреляет победителя.
     * 
     * Это единственная функция, которая может менять состояние игры.
     */
    public function makeMove($x, $y) {
        // Учитываем ход, если выполняются все условия:
        // 1) игра ещё идет,
        // 2) клетка находится в пределах игрового поля.
        // 3) в поле на указанном месте ещё пусто,
        if(
                $this->currentPlayer
                &&
                $x >= 0 && $x < $this->fieldWidth
                &&
                $y >= 0 && $y < $this->fieldHeight
                &&
                empty($this->field[$x][$y]))
        {
                $current = $this->currentPlayer;
                
                $this->field[$x][$y] = $current;
	        $this->checkWinner();//проверяем на выигрыш
		if($this->currentPlayer)
	{
                $this->currentPlayer = ($current == 1) ? 2 : 1;
                
                //alex
               if ($this->currentGame==2){
                        $x=rand(0, $this->fieldWidth);
                        $y=rand(0,$this->fieldHeight);
                        $current = $this->currentPlayer;
                        $this->field[$x][$y] = $current;
                        $this->currentPlayer = ($current == 1) ? 2 : 1;
                } elseif ($this->currentGame==3) {

                        
                        $i=1;
                        while ($i <= 8)
			{
                            $xz=rand(0, 2);
                            $yz=rand(0,2);
                            if ( empty($this->field[$xz][$yz]) ){
                                $x=$xz;
                                $y=$yz;
                            } 
                            $i++;
                        }
                       
                        if (!$this->checkWinner()=='true'){
                        $current = $this->currentPlayer;
                        $this->field[$x][$y] = $current;
                        $this->currentPlayer = ($current == 1) ? 2 : 1;
                        }  

                  


                }elseif ($this->currentGame==4) {
/***************************************************************/                       
/*alex algoritm start here!*/
                if($this->checkStrings(2)=='true')
                {
                    $x=$this->xa;//1;//$xa;
                    $y=$this->ya;//1;//$ya;
                }elseif($this->checkColums(2)=='true')
		{
                    $x=$this->xa;//1;//$xa;
                    $y=$this->ya;//1;//$ya;
		}elseif($this->checkdiagonala(2)=='true') 
                {
                    $x=$this->xa;//1;//$xa;
                    $y=$this->ya;//1;//$ya;
        }elseif($this->checkdiagonalb(2)=='true') 
                {
                    $x=$this->xa;//1;//$xa;
                    $y=$this->ya;//1;//$ya;
        }else if($this->checkStrings(1)=='true')
                {
                    $x=$this->xa;//1;//$xa;
                    $y=$this->ya;//1;//$ya;
                }elseif($this->checkColums(1)=='true')
		{
                    $x=$this->xa;//1;//$xa;
                    $y=$this->ya;//1;//$ya;
		}elseif($this->checkdiagonala(1)=='true') 
                {
                    $x=$this->xa;//1;//$xa;
                    $y=$this->ya;//1;//$ya;
        }elseif($this->checkdiagonalb(1)=='true') 
                {
                    $x=$this->xa;//1;//$xa;
                    $y=$this->ya;//1;//$ya;
        }else
                {
                     $i=1;
                        while ($i <= 8) {
                                 $xz=rand(0, 2);
                                 $yz=rand(0,2);
                            if ( empty($this->field[$xz][$yz]) ){
                                  $x=$xz;
                                $y=$yz;
                            } 
                            $i++;
			}
//$x=2;
//$y=2;
                }

/*alex algoritm end*/
/***************************************************************/                       
//                        if (!$this->checkWinner()=='true'){
                        if (empty($this->field[$x][$y])){
                        $current = $this->currentPlayer;
                        $this->field[$x][$y] = $current;
                        $this->currentPlayer = ($current == 1) ? 2 : 1;
                        }  

            $this->checkWinner();
    
                  }
	}

      } 

}
/**/

/**/

   private function checkdiagonala($maska) {

        $counter=0;
        $xa=-1;
        for ($tmp=0; $tmp < $this->fieldHeight; $tmp++)
        {
             if($this->field[$tmp][$tmp] == $maska)
               { $counter++;}
            elseif(empty($this->field[$tmp][$tmp]))
            {
        $xa=1;
                $this->xa=$tmp;
                $this->ya=$tmp;
            }
        }

        if ($counter > 1 && $xa>=0)
            return true;
    return false;

}

/**/
private function checkdiagonalb($maska) {

        $counter=0;
        $xa=-1;
        for ($tmp=0; $tmp < $this->fieldHeight; $tmp++)
        {
             if($this->field[$tmp][2-$tmp] == $maska)
               { $counter++;}
            elseif(empty($this->field[$tmp][2-$tmp]))
            {
        $xa=1;
                $this->xa=$tmp;
                $this->ya=2-$tmp;
            }
        }

        if ($counter > 1 && $xa>=0)
            return true;
    return false;

}


/**/

/**/
    private function checkColums($maska) {
	for($i=0;$i<$this->fieldHeight;$i++)
    		if($this->checkColum($i,$maska)=='true')
          	  return true;
    return false;
}
    private function checkColum($Number,$maska) {
        $counter=0;
        $xa=-1;
        for ($tmp=0; $tmp < $this->fieldHeight; $tmp++)
        {
             if($this->field[$tmp][$Number] == $maska)
               { $counter++;}
            elseif(empty($this->field[$tmp][$Number]))
            {
		$xa=1;
                $this->xa=$tmp;
                $this->ya=$Number;
            }
        }

        if ($counter > 1 && $xa>=0)
            return true;
    return false;
}

/**/
    private function checkStrings($maska) {
	for($i=0;$i<$this->fieldWidth;$i++)
    		if($this->checkString($i,$maska)=='true')
          	  return true;
    return false;
}
    private function checkString($Number,$maska) {
        $counter=0;
        $xa=-1;
        for ($tmp=0; $tmp < $this->fieldHeight; $tmp++)
        {
             if($this->field[$Number][$tmp] == $maska)
               { $counter++;}
            elseif(empty($this->field[$Number][$tmp]))
            {
		$xa=1;
                $this->xa=$Number;
                $this->ya=$tmp;
            }
        }

        if ($counter > 1 && $xa>=0)
            return true;
    return false;
}
  
    /**
     * Делает поиск выигравшей комбинации, проходя по всему полю и проверяя
     * 4 направления (горизонталь, вертикаль и 2 диагонали).
     */
    private function checkWinner() {
        for($y = 0; $y < $this->fieldHeight; $y++) {
            for($x = 0; $x < $this->fieldWidth; $x++) {
                $this->checkLine($x, $y, 1, 0);
                $this->checkLine($x, $y, 1, 1);
                $this->checkLine($x, $y, 0, 1);
                $this->checkLine($x, $y, -1, 1);
            }
        }
        if($this->winner) {
            $this->currentPlayer = null;
        }
    }
    
    /**
     * Проверяет, а не находится ли в этом месте поля выигрышная комбинация
     * из необходимого числа крестиков или ноликов.
     * Если выигрышная комбинация найдена, запоминает победителя
     * и саму выигрышную комбинацию в массиве winnerCells.
     * 
     * @param $startX начальная точка, от которой проверять наличие комбинации
     * @param $startY
     * @param $dx направление, в котором искать комбинацию
     * @param $dy
     */
    private function checkLine($startX, $startY, $dx, $dy) {
        $x = $startX;
        $y = $startY;
        $field = $this->field;
        $value = isset($field[$x][$y])? $field[$x][$y]: null;
        $cells = array();
        $foundWinner = false;
        if($value) {
            $cells[] = array($x, $y);
            $foundWinner = true;
            for($i=1; $i < $this->countToWin; $i++) {
                $x += $dx;
                $y += $dy;
                $value2 = isset($field[$x][$y])? $field[$x][$y]: null;
                if($value2 == $value) {
                    $cells[] = array($x, $y);
                } else {
                    $foundWinner = false;
                    break;
                }
            }
        }
        if($foundWinner) {
            foreach($cells as $cell) {
                $this->winnerCells[$cell[0]][$cell[1]] = $value;
            }
            $this->winner = $value;
        }
    }

    /*
     * Функции ниже позволяют получить текущее состояние игры и игрового поля.
     */
    public function getCurrentType() { return $this->currentGame; }
    public function getCurrentPlayer() { return $this->currentPlayer; }
    public function getWinner()        { return $this->winner; }
    public function getField()         { return $this->field; }
    public function getWinnerCells()   { return $this->winnerCells; }
    public function getFieldWidth()    { return $this->fieldWidth; }
    public function getFieldHeight()   { return $this->fieldHeight; }
}