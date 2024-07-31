<!DOCTYPE html>
<html>
<head>
<style> 
    #main {
        width: 100%;
        height: 100vw;
        border: 1px solid #c3c3c3;
        display: flex;
        flex-direction: column;
        flex-wrap: wrap;
        align-content: flex-start;
    }

    #main div {
        width: 50px;
        height: 50px;
        margin: 0px;
    }

    .float-layout {
	  padding: 5px 5px;
	  float: left;
	  width: 100%;
	  height: auto;
	  box-sizing: border-box;
	  margin: 0;
	}

	.card-container {
	  overflow: hidden;
	}

	.card {
	  background-color: dodgerblue;
	  color: black;
	  min-height: 100%; /*replace this it in width: 100%*/
	  width: 50%;
	  float: right;
	}

	.card-title {
	  font-size: 30px;
	  text-align: center;
	  font-weight: bold;
	  padding-top: 20px;
	}

	.card-desc {
	  padding: 10px;
	  text-align: left;
	  font-size: 18px;
	}

	/*add this it*/
	.card-image {
	  display: flex;
	}
	/*-------------*/

	div.card-image img {
	  width: 50%;
	  height: auto;
	}

	/* Phone Devices Query */
	@media only screen and (max-width: 37.5em) {
	  div.card-image img {
		width: 100%;
		height: auto;
	  }
	  
	  /*add this it*/
	  .card-image {
		 flex-direction: column;
	  }
	  /*----------------------*/

	  .card {
		width: 100%;
		margin-top: -4px;
	  }
}
</style>
</head>
<body>

    {{-- <h1>The flex-direction Property</h1> --}}

    {{-- <div id="main">
        <div style="background-color:coral;">A</div>
        <div style="background-color:lightblue;">B</div>
        <div style="background-color:khaki;">C</div>
        <div style="background-color:pink;">D</div>
        <div style="background-color:lightgrey;">E</div>
        <div style="background-color:lightgreen;">F</div>
        <div style="background-color:coral;">A</div>
        <div style="background-color:lightblue;">B</div>
        <div style="background-color:khaki;">C</div>
        <div style="background-color:pink;">D</div>
        <div style="background-color:lightgrey;">E</div>
        <div style="background-color:lightgreen;">F</div>
        <div style="background-color:coral;">A</div>
        <div style="background-color:lightblue;">B</div>
        <div style="background-color:khaki;">C</div>
        <div style="background-color:pink;">D</div>
        <div style="background-color:lightgrey;">E</div>
        <div style="background-color:lightgreen;">F</div>
        <div style="background-color:coral;">A</div>
        <div style="background-color:lightblue;">B</div>
        <div style="background-color:khaki;">C</div>
        <div style="background-color:pink;">D</div>
        <div style="background-color:lightgrey;">E</div>
        <div style="background-color:lightgreen;">F</div>
        <div style="background-color:coral;">A</div>
        <div style="background-color:lightblue;">B</div>
        <div style="background-color:khaki;">C</div>
        <div style="background-color:pink;">D</div>
        <div style="background-color:lightgrey;">E</div>
        <div style="background-color:lightgreen;">F</div>
        <div style="background-color:coral;">A</div>
        <div style="background-color:lightblue;">B</div>
        <div style="background-color:khaki;">C</div>
        <div style="background-color:pink;">D</div>
        <div style="background-color:lightgrey;">E</div>
        <div style="background-color:lightgreen;">F</div>
        <div style="background-color:coral;">A</div>
        <div style="background-color:lightblue;">B</div>
        <div style="background-color:khaki;">C</div>
        <div style="background-color:pink;">D</div>
        <div style="background-color:lightgrey;">E</div>
        <div style="background-color:lightgreen;">F</div>
        <div style="background-color:coral;">A</div>
        <div style="background-color:lightblue;">B</div>
        <div style="background-color:khaki;">C</div>
        <div style="background-color:pink;">D</div>
    </div> --}}

    <div id="main">
        <div style="background-color: red">
            <img src="" alt="">
            <h5>Yahoo</h5>
        </div>
    </div>

    <p><b>Note:</b> Internet Explorer 10 and earlier versions do not support the flex-direction property.</p>

</body>
</html>