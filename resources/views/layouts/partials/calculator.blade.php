<div id="calculator" class="notActive">
    <div class="">
      <div class="" id="result">
        <form name="calc">
          <input type="text" class="screen text-right" name="result" readonly>
        </form>
      </div>
      <div class="d-flex">
        <button id="allClear" type="button" class="btn flex-grow-1 calcbtn control" onclick="clearScreen()">AC</button>
        <button id="clear" type="button" class="btn flex-grow-1 calcbtn control" onclick="clearScreen()">CE</button>
        <button id="%" type="button" class="btn flex-grow-1 calcbtn control" onclick="calEnterVal(this.id)">%</button>
        <button id="/" type="button" class="btn flex-grow-1 rightcol calcbtn" onclick="calEnterVal(this.id)">÷</button>
      </div>
      <div class="d-flex">
        <button id="7" type="button" class="btn flex-grow-1 calcbtn number" onclick="calEnterVal(this.id)">7</button>
        <button id="8" type="button" class="btn flex-grow-1 calcbtn number" onclick="calEnterVal(this.id)">8</button>
        <button id="9" type="button" class="btn flex-grow-1 calcbtn number" onclick="calEnterVal(this.id)">9</button>
        <button id="*" type="button" class="btn flex-grow-1 rightcol calcbtn" onclick="calEnterVal(this.id)">×</button>
      </div>
      <div class="d-flex">
        <button id="4" type="button" class="btn flex-grow-1 calcbtn number" onclick="calEnterVal(this.id)">4</button>
        <button id="5" type="button" class="btn flex-grow-1 calcbtn number" onclick="calEnterVal(this.id)">5</button>
        <button id="6" type="button" class="btn flex-grow-1 calcbtn number" onclick="calEnterVal(this.id)">6</button>
        <button id="-" type="button" class="btn flex-grow-1 rightcol calcbtn" onclick="calEnterVal(this.id)">-</button>
      </div>
      <div class="d-flex">
        <button id="1" type="button" class="btn flex-grow-1 calcbtn number" onclick="calEnterVal(this.id)">1</button>
        <button id="2" type="button" class="btn flex-grow-1 calcbtn number" onclick="calEnterVal(this.id)">2</button>
        <button id="3" type="button" class="btn flex-grow-1 calcbtn number" onclick="calEnterVal(this.id)">3</button>
        <button id="+" type="button" class="btn flex-grow-1 rightcol calcbtn" onclick="calEnterVal(this.id)">+</button>
      </div>
      <div class="d-flex">
        <button id="0" type="button" style="flex-basis: 25%;" class="btn calcbtn number" onclick="calEnterVal(this.id)">0</button>
        <button id="." type="button" style="flex-basis: 25%;" class="btn calcbtn number" onclick="calEnterVal(this.id)">.</button>
        <button id="equals" type="button" style="flex-basis: 50%;" class="btn calcbtn rightcol" onclick="calculate()">=</button>
      </div>
    </div>
</div>



<script src="{{ asset('assets/backend/js/models/calculator.js?v='.$asset_v) }}"></script>