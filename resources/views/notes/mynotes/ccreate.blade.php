<meta name="viewport" content="width=device-width, initial-scale=1">
<div style="padding:20px;margin-top:30px;">
    <h1>新增教材筆記</h1>

    @if ($message = Session::get('alert'))
        <script>alert("{{ $message }}");</script>
    @endif

    <div id="addpeo" style="display:none">
        <form>
            列出同班同學名稱：
            <select>
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
            </select>
            @foreach($classmate as $classmates)
                {{$classmates}} <input type="checkbox">
            @endforeach
        </form>
    </div>

    <div style="display:none">
        <img id="scream" width="220" height="277"
             src="{{asset('images/uccu/uccu1.jpg')}}" alt="m">
    </div>

    <div style="display: none">
        <input name="valuetojs" value="testsendvalue">
    </div>

    <form id="json" name="json" method="POST" action="/notes" enctype="multipart/form-data">
        @csrf
        <p>
        課程：<span class="span.mark-pen" style="background-image: linear-gradient(transparent 50%, rgb(255, 255, 153) 50%)">
            <input type="text" name="class" id="class" value="{{$course}}" SIZE={{strlen($course)}} readonly style="background-color: transparent; font-size: 16px; border-style: none"></span>
        </p>
        筆記名稱：<input name="notename" id="notename" style="font-size: 16px;margin-top: -5px">&emsp;

        <div style="display: none">
            <input name="classId" value="{{$classId}}">
            <input name="textbookId" value="{{$textbookId}}">
        </div>

        <div style="display:none">
            <input name="json" id="json">
            <img id="jsonimg" width="220" height="277"
                 src="" alt="">
            筆記頁數：<input name="pages" id="pages" value="{{count($images)}}">
        </div>


{{--        <button id="send1" name="send" type="submit" disabled="disabled">傳送</button>--}}
        <button onclick="add()" id="send" name="send" type="submit" style="font-size: 14px">儲存筆記</button>
        <div style="display: none">
            <input name="valuetojs" value="testsendvalue">
        </div>

    </form>
{{--    <button onclick="add()" id="send" name="send">儲存</button>--}}

    <input id="word" type="checkbox">&ensp;移動文字&ensp;|&ensp;
    <input id="pic" type="checkbox">&ensp;移動插圖&ensp;|&ensp;


    <button style="font-size: 14px"><div id="clear">清空畫布</div></button>&ensp;|&ensp;

    <button onclick="opentext()" class="btn btn-outline-info"><i class="fa fa-book" aria-hidden="true" style="font-size: 16px"></i></button>

<p></p><br>
    <div style="position: relative">
    <div align="left">
        <input readonly="readonly" id="page" value="" style="color: #be2617;text-align: center;" SIZE={{strlen(count($images))}}>&ensp;/&ensp;{{count($images)}}&ensp;,
        第
        @for($i=0;$i<count($images);$i++)
            <button onclick="bookimg({{$i+1}})" id="num" class="btn btn-danger btn-sm">{{$i+1}}</button>
        @endfor頁
    </div>

    <p id="demo"></p>


    <div style="position: relative;" id="above">
        <canvas id="note" width="1000" height="1413" style="position: absolute; left: 0; top: 0; z-index: 4;border-style:solid;border-color:gray;border-width:1px;"></canvas>
        {{--    background-image:url({{asset('images/uccu/uccu1.jpg')}});--}}
        <canvas id="textlayer" width="1000" height="1413"
                style="position: absolute; left: 0; top: 0; z-index: 3;"></canvas>
        <canvas id="imglayer" width="1000" height="1413"
                style="position: absolute; left: 0; top: 0; z-index: 2;"></canvas>
        <canvas id="textbooklayer" width="1000" height="1413"
                style="position: absolute; left: 0; top: 0px; z-index: 1;
                    background-image:url('{{asset('/images/'.$textbook->name.'/'.$images[0])}}');background-repeat:no-repeat; background-size:contain;">
        </canvas>

    </div>

    <canvas id="c2" width="1000" height="1413"></canvas>
    </div>
</div>

<div class="tool" id="toolid">
    <a href="#about"><i class="fas fa-highlighter"></i> 螢光筆</a>
    <form style="margin:0" id="penform" name="penform">
        <a><input name="pen" id="pen" type="range" min="1" max="20" step="1" value="2"></a>
        <a><input readonly="readonly" name="penvalue" id="penvalue" size="1" style="text-align:center"></a>
        <a><input type="color" name="pencolor" id="pencolor" value="#000000"></a>
    </form>
    <a><i class="fas fa-font"></i><button onclick="textbox()" style="font-size: 17px;">文字</button><div class="textpx"><button class="textpx">
                <i class="fa fa-caret-down"></i>
            </button><div class="px">
                <form style="margin:0" id="textform" name="textform">
                    <select id="tpx">
                        <option value="" >文字大小</option>
                        <option value="14">14</option>
                        <option value="16">16</option>
                        <option value="20">20</option>
                        <option value="24">24</option>
                        <option value="32">32</option>
                        <option value="40">40</option>
                        <option value="64">64</option>
                        <option value="96">96</option>
                    </select>
                    <select id="tty">
                        <option value="" >字型設定</option>
                        <option value="Arial">Arial</option>
                        <option value="標楷體">標楷體</option>
                        <option value="新細明體">新細明體</option>
                        <option value="Arial Black">Arial Black</option>
                        <option value="Noto Sans TC">Noto Sans TC</option>
                    </select>
                    <input type="color" id="tco" value="#000000">
                </form>
            </div></div></a>

    <form style="margin:0" id="text" name="text">
        <a><input name="text" id="text"></a>
    </form>
    <a href="#clients"><i class="fas fa-eraser"></i> 橡皮擦<input id="erasere" type="checkbox"></a>

    <form style="margin:0" id="image" name="image" method="POST" action="/image" enctype="multipart/form-data" onsubmit="return imgtocanvas(e)">
        @csrf
        @method('POST')
        <a><i class="fas fa-camera"></i> 圖片<input type="file" name="img" id="imgup" accept="image/*;" capture="camera" ></a>
        <div style="display:none">
            <button id="to" name="to" type="submit" value="send"></button>
        </div>
    </form>
    <a href="/textbooks/show/{{$textbookId}}"><i class="fas fa-arrow-left" style="color:#FFFFFF"></i></a>
    <a href="/"><i class="fas fa-home home" style="color:#FFFFFF"></i></a>
    <a href="javascript:void(0);" class="icon" onclick="hidd()"><i class="fa fa-bars"></i></a>
</div>
{{--    <textarea id="myTextarea" style="resize:none;width:1191px;height:1684px;">--}}
{{--        文字方塊測試~--}}
{{--    </textarea>--}}

<style>
    canvas {
        width: 1000px;
        height: 1413px;
    }

    body{
        background: #F0F0F0;
    }

    .tool {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        z-index: 4;
        background-color: #333;
        position: fixed;
        top: 0;
        width: 100%;
    }
    .tool a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    .tool a:hover {
        background-color: #ddd;
        color: black;
    }

    .tool a.active {
        background-color: #4CAF50;
        color: white;
    }

    .tool .icon {
        display: none;
    }

    .tool button {
        background-color:transparent;
        border-style:none;
        color:white;
    }
    .tool button:hover {
        background-color: #ddd;
        color: black;
    }

    @media screen and (max-width: 600px) {
        .tool a:not(:first-child) {display: none;}
        .tool a.icon {
            float: right;
            display: block;
        }
    }
    @media screen and (max-width: 600px) {
        .tool.responsive {
            position: fixed;
            top: 0;
            width: 100%;}
        .tool.responsive .icon {
            position: absolute;
            right: 0;
            top: 0;
        }
        .tool.responsive a {
            float: none;
            display: block;
            text-align: left;
        }
    }
    .home{
        float: right;
    }

    .px {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    }

    .px p{
        float: none;
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
        z-index: 5;
    }

    .textpx:focus-within .px{
        display: block;
    }

</style>

<script>
    let isloading = false; //防止連按
    let nowPage = 1; //目前第幾頁
    let jsonStash = [];//暫時儲存json
    let textarrStash = [];
    let linesStash = [];
    let picarrStash = [];
    let wordareaStash = [];

    document.getElementById("page").value=`${nowPage}`;

    let isDrawing = false;
    let x = 0;
    let y = 0;


    const note = document.getElementById('note');
    const context = note.getContext('2d');
    const textlayer = document.getElementById('textlayer');
    const textcontext = textlayer.getContext('2d');
    const imglayer = document.getElementById('imglayer');
    const imgcontext = imglayer.getContext('2d');
    const textbooklayer = document.getElementById('textbooklayer');
    const textbookcontext = textbooklayer.getContext('2d');
    let textarea = document.createElement('textarea');
    textarea.value='';
    textarea.style="resize:none";
    textarea.style.width=1000;
    textarea.style.height=1413;
    // const send = document.getElementById('send');

    // send.addEventListener("click", function(){
    //     // isloading = true;
    //     document.getElementById("send").disabled = true;
    // });
    // $('json').preventDoubleSubmission();

    note.addEventListener('mousedown', e => {
        x = e.offsetX;
        y = e.offsetY;
        isDrawing = true;

        if (erasere.checked&&note.click) {
            for (var i = 0; i < lines.length; i++) {
                if (x >= lines[i].start[0] && x <= lines[i].end[0]&&y<=lines[i].start[1]+5&&y>=lines[i].start[1]-5) {
                    context.globalAlpha = 1;
                    context.lineWidth = document.penform.pen.value;
                    context.strokeStyle = "#ffffff";
                    var w=+lines[i].width[0];
                    context.lineWidth=w+1;
                    context.globalCompositeOperation="destination-out";
                    context.beginPath();
                    context.moveTo(lines[i].start[0], lines[i].start[1]);
                    context.lineTo(lines[i].end[0], lines[i].end[1]);
                    context.stroke();
                    context.closePath();
                    lines.splice(i, 1);
                    isDrawing = false;
                }
            }
            for(var j=0; j<textarr.length; j++){
                if(x<=textarr[j].location[0]+textarr[j].width&&x>=textarr[j].location[0]&&y<=textarr[j].location[1]&&y>=textarr[j].location[1]-textarr[j].height){
                    textcontext.clearRect(textarr[j].location[0], textarr[j].location[1]-textarr[j].height, textarr[j].width, textarr[j].height+11);
                    textarr.splice(j, 1);
                    isDrawing = false;
                }
            }
            for(var k=0; k<picarr.length; k++){
                if(x<=picarr[k].location[0]+picarr[k].width[0]&&x>=picarr[k].location[0]&&y>=picarr[k].location[1]&&y<=picarr[k].location[1]+picarr[k].height[0]){
                    imgcontext.clearRect(picarr[k].location[0], picarr[k].location[1], picarr[k].width, picarr[k].height);
                    picarr.splice(k, 1);
                    isDrawing = false;

                }
            }
        }

        else if (isDrawing === true && erasere.checked===false ) {
            drawLine(context, x, y, e.offsetX, e.offsetY);
            x = e.offsetX;
            y = e.offsetY;
        }
    });

    note.addEventListener('mousemove', e => {
        if (erasere.checked===true||word.checked===true||pic.checked===true) {
            isDrawing = false;

        }

    });

    let lines = []
    window.addEventListener('mouseup', e => {
        if (isDrawing === true && erasere.checked===false && word.checked===false&&pic.checked===false) {
            drawLine(context, x, y, e.offsetX, e.offsetY);


            if (x !== e.offsetX) {

                const line = {
                    start: [x, y],
                    end: [e.offsetX, y],
                    color:[document.penform.pencolor.value],
                    width:[document.penform.pen.value]
                }
                lines.push(line)
            }
        }
        if(erasere.checked===false&&note.click&& word.checked===true&& pic.checked===false) {
            for (var j = 0; j < textarr.length; j++) {
                if(x<=textarr[j].location[0]+textarr[j].width&&x>=textarr[j].location[0]&&y<=textarr[j].location[1]&&y>=textarr[j].location[1]-textarr[j].height) {
                    console.log('hey tiz')

                    console.log(textarr[j].location[0])
                    console.log(textarr[j].location[1])
                    // textcontext.clearRect(textarr[j].location[0], textarr[j].location[1]-textarr[j].height, textarr[j].width, textarr[j].height+11);
                    if(textarr[j].height>= 64){
                        textcontext.clearRect(textarr[j].location[0], textarr[j].location[1]-textarr[j].height+25, textarr[j].width, textarr[j].height);
                    }
                    else
                    {
                        textcontext.clearRect(textarr[j].location[0], textarr[j].location[1]-textarr[j].height, textarr[j].width, textarr[j].height+11);
                    }
                    textarr[j].location[0]=e.offsetX;
                    textarr[j].location[1]=e.offsetY;
                    console.log(textarr[j].location[0])
                    console.log(textarr[j].location[1])
                    console.log(textarr)
                    var a = JSON.stringify(textarr[j].form);
                    var length =a.length;
                    if(length===7){
                        textcontext.font = "30px Arial";
                        textcontext.fillStyle=textarr[j].color;
                        textcontext.fillText(textarr[j].text, textarr[j].location[0],textarr[j].location[1]);
                    }
                    else if (length!==7){
                        textcontext.font = textarr[j].form;
                        textcontext.fillStyle=textarr[j].color;
                        textcontext.fillText(textarr[j].text, textarr[j].location[0],textarr[j].location[1]);
                    }
                    // textcontext.font = textarr[j].form;
                    // textcontext.fillStyle=textarr[j].color;
                    // textcontext.fillText(textarr[j].text, textarr[j].location[0],textarr[j].location[1]);
                    textarr[j].width = textcontext.measureText(textarr[j].text).width;
                    textarr[j].height = parseInt(textcontext.font.match(/\d+/), 10);
                }
            }
        }

        if(erasere.checked===false&&note.click&& word.checked===false&& pic.checked===true) {
            for (var k = 0; k < picarr.length; k++) {
                if(x<=picarr[k].location[0]+picarr[k].width[0]&&x>=picarr[k].location[0]&&y>=picarr[k].location[1]&&y<=picarr[k].location[1]+picarr[k].height[0]) {
                    console.log('hey mochi')

                    console.log(picarr[k].location[0])
                    console.log(picarr[k].location[1])
                    imgcontext.clearRect(picarr[k].location[0], picarr[k].location[1], picarr[k].width, picarr[k].height);

                    picarr[k].location[0]=e.offsetX;
                    picarr[k].location[1]=e.offsetY;
                    console.log(picarr[k].location[0])
                    console.log(picarr[k].location[1])
                    console.log(picarr)


                    document.json.jsonimg.src="{{asset('images/')}}"+"/"+picarr[k].path[0]
                    // var img = new Image();json
                    // img.src=document.json.img.src;
                    imgcontext.drawImage(jsonimg, picarr[k].location[0], picarr[k].location[1]);


                }
            }
        }

        else {
            x = 0;
            y = 0;

        }
        isDrawing = false;

    });
    note.addEventListener('touchstart', e => {
        document.getElementById("demo").innerHTML = "手機";
    });

    function drawLine(context, x1, y1, x2, y2) {
        context.beginPath();
        context.moveTo(x1, y1);
        context.lineTo(x2, y1);

        if(word.checked===false&&pic.checked===false) {
            context.stroke();
            context.closePath();
        }
    }


    let linetext= []
    function add(){
    // console.error(isloading);
    //     if(isloading == false) {
    //         isloading = true;
            //暫時儲存
            linetext.push(textarr)
            linetext.push(lines)
            linetext.push(picarr)
            linetext.push(textarea.value)
            console.error(linetext);
            var linestr = JSON.stringify(linetext);

            textarrStash[nowPage - 1] = textarr;
            linesStash[nowPage - 1] = lines;
            picarrStash[nowPage - 1] = picarr;
            wordareaStash[nowPage - 1] = textarea.value;
            jsonStash[nowPage - 1] =linestr;


            let finalJson = [];
            //最後儲存的json
            for (var i = 0; i < {{count($images)}}; i++) {
                if (jsonStash[i] == null) finalJson[i] = [[],[],[],''];
                else finalJson[i] = JSON.parse(jsonStash[i]);
            }
            console.error({{count($images)}});
            console.log(finalJson,123)
            document.json.json.value = JSON.stringify(finalJson);
        //     document.getElementById("send1").disabled = false;
        //
        //     isloading = false;
        //
        // } else {
        //     console.error("123");
        // }

    }
    //new
    let textarr = []

    function textbox() {
        const dspace = document.text.text.value.replace(/^\s*|\s*$/g,"");
        if(dspace!=="") {
            const note = document.getElementById('note');
            const context = note.getContext('2d');
            const word = {
                location: [50, 50],
                text: [dspace],
                form:[document.textform.tpx.value + "px " + document.textform.tty.value],
                color:[document.textform.tco.value]
            }
            textarr.push(word)
            console.log(textarr)

            // textcontext.font = "30px Arial";
            if(document.textform.tpx.value===""||document.textform.tty.value===""){
                textcontext.font = "30px Arial";
            }
            else {
                textcontext.font = document.textform.tpx.value + "px " + document.textform.tty.value;
            }
            textcontext.fillStyle=document.textform.tco.value;
            textcontext.fillText(dspace, 50, 50);
            word.width = textcontext.measureText(word.text).width;
            word.height =parseInt(textcontext.font.match(/\d+/), 10);
        }
    }

    clear.addEventListener('click',function(){
        const note = document.getElementById('note');
        const context = note.getContext('2d');
        context.clearRect(0,0,note.width,note.height);

        const textlayer = document.getElementById('textlayer');
        const textcontext = textlayer.getContext('2d');
        textcontext.clearRect(0,0,textlayer.width,textlayer.height);

        const imglayer = document.getElementById('imglayer');
        const imgcontext = imglayer.getContext('2d');
        imgcontext.clearRect(0,0,imglayer.width,imglayer.height);

        //清除當頁暫存
        jsonStash[nowPage - 1] = null;
        textarrStash[nowPage - 1]  = null;
        linesStash[nowPage - 1]  = null;
        picarrStash[nowPage - 1]  = null;

        //清除畫線
        linetext = [];
        textarr = [];
        lines= [];
        picarr = [];
    });

    function save() {
        const note = document.getElementById('note');
        var dataURL=note.toDataURL('image/png');
        const link = document.createElement('a');
        link.innerText = '下載圖片';
        link.href = dataURL;
        link.download = 'download.png';
        document.body.appendChild(link);

    }


    window.onload = function() {

    }

    function hidd() {
        var x = document.getElementById("toolid");
        if (x.className === "tool") {
            x.className += " responsive";
        } else {
            x.className = "tool";
        }
    }


    function addeditor(){
        document.getElementById("addpeo").style.display="block";
    }


    // var opent = document.getElementById("note"),
    let isOpen = 0;
    let wordarea=[];
    function opentext(){

        if(isOpen === 0) {
            // textarea = document.createElement('textarea');
            // document.body.appendChild(textarea);
            isOpen = 2;
            var list=document.getElementById("above")
            list.insertBefore(textarea,list.childNodes[0]);
            note.style.display="none";
            textlayer.style.display="none";
            imglayer.style.display="none";
            textbooklayer.style.display="none";

        } else {
            if (isOpen == 1) {
                textarea.hidden = false;
                isOpen = 2;
                var list=document.getElementById("above")
                list.insertBefore(textarea,list.childNodes[0]);
                note.style.display="none";
                textlayer.style.display="none";
                imglayer.style.display="none";
                textbooklayer.style.display="none";
                textarea.style.display="block";
            }
            else{
                textarea.hidden = true;
                isOpen = 1;
                textarea.style.display="none";
                note.style.display="block";
                textlayer.style.display="block";
                imglayer.style.display="block";
                textbooklayer.style.display="block";
            }
        }


        // textarea.value = "測試";
        // textarea.value='';
        // textarea.style="resize:none";
        // textarea.style.width=1191;
        // textarea.style.height=1684;

    }
</script>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
<script>
    $("#imgupload").change(function(){
        readURL(this);

    });

    function readURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function (e) {
                $("#image").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }


    var imageLoader = document.getElementById('imgup');
    imageLoader.addEventListener('change', imgtocanvas, false);
    let picarr=[]

    function imgtocanvas(e){

        $("#image").ajaxSubmit(function() {
        });


        var reader = new FileReader();
        reader.onload = function(e){
            var img = new Image();
            img.onload = function(){

                imgcontext.drawImage(img,0,0,img.width,img.height);
                let pic = {
                    location: [0, 0],
                    path: [imageLoader.value.split("\\").pop()],
                    width:[img.width],
                    height:[img.height]
                }

                picarr.push(pic)
                console.log(picarr)
            }
            img.src = e.target.result;
        }
        reader.readAsDataURL(e.target.files[0]);
    }

    pen.addEventListener("change", function (){

        for(var p=0;p<=20;p++){
            document.penform.penvalue.value=document.penform.pen.value;
            const pensize=+document.penform.pen.value;
            if (pensize === p) {
                context.globalAlpha = 0.5;
                context.globalCompositeOperation = "source-over";
                context.lineWidth = p;
                context.strokeStyle = document.penform.pencolor.value;

            }
        }

    },false);


    pencolor.addEventListener("change", function (){
        context.globalCompositeOperation = "source-over";
        document.penform.penvalue.value=document.penform.pen.value;
        context.globalAlpha = 0.5;
        context.strokeStyle = document.penform.pencolor.value;

    },false);

        function bookimg(num) {

            //獲得資源
            const note = document.getElementById('note');
            const context = note.getContext('2d');
            const textlayer = document.getElementById('textlayer');
            const textcontext = textlayer.getContext('2d');
            const imglayer = document.getElementById('imglayer');
            const imgcontext = imglayer.getContext('2d');



            //暫時儲存
            linetext.push(textarr)
            linetext.push(lines)
            linetext.push(picarr)
            linetext.push(textarea.value)
            console.error(linetext);
            var linestr = JSON.stringify(linetext);

            textarrStash[nowPage - 1] = textarr;
            linesStash[nowPage - 1] = lines;
            picarrStash[nowPage - 1] = picarr;
            wordareaStash[nowPage - 1] = textarea.value;
            jsonStash[nowPage - 1] =linestr;

            linetext = [];
            textarr = [];
            lines= [];
            picarr = [];
            textarea.value = '';

            nowPage = num;
            //清除
            context.clearRect(0,0,note.width,note.height);
            textcontext.clearRect(0,0,textlayer.width,textlayer.height);
            imgcontext.clearRect(0,0,imglayer.width,imglayer.height);
            //清除文字方塊陣列

            //換頁內容
            const base = '{{asset('/images/'.$textbook->name)}}';
            let images = [];
            @foreach($images as $row)
            images.push('{{$row}}');
            @endforeach
            console.error(images.length,123);
            let a = base+"/"+images[num-1];
            document.getElementById('textbooklayer').style.backgroundImage=`url(${a})`;

            changeJson(num - 1);
            document.getElementById("page").value=`${num}`;
    }

        function changeJson(index) {
            if (typeof jsonStash[index] !== 'undefined') {
                //換到n頁時，給n頁的值
                textarr = textarrStash[index];
                lines= linesStash[index];
                picarr = picarrStash[index];
                textarea.value = wordareaStash[index];
                //json decode
                const objson=JSON.parse(jsonStash[index]);
                const note = document.getElementById('note');
                const context = note.getContext('2d');
                const textlayer = document.getElementById('textlayer');
                const textcontext = textlayer.getContext('2d');
                const imglayer = document.getElementById('imglayer');
                const imgcontext = imglayer.getContext('2d');

                for(var k=0;k<objson[2].length;k++){ // 畫圖片（第三個ARRAY）
                    document.json.jsonimg.src="{{asset('images/')}}"+"/"+objson[2][k].path[0]
                    var img = new Image();
                    img.src=document.json.jsonimg.src;
                    console.error(document.json.jsonimg.src)
                    imgcontext.drawImage(img, objson[2][k].location[0], objson[2][k].location[1]);//drawImage(image, x, y)或drawImage(image, x, y, width, height) width跟height是縮放用的
                    console.error(objson[2][k].location[0], objson[2][k].location[1]);
                }
                for(var j=0 ; j < objson[0].length ; j++){ //文字
                    var l = JSON.stringify(objson[0][j].form);
                    var length =l.length;
                    if(length===7){
                        console.log("是");
                        textcontext.font = "30px Arial";
                        textcontext.fillStyle=objson[0][j].color;
                        textcontext.fillText(objson[0][j].text, objson[0][j].location[0],objson[0][j].location[1]);
                    }
                    else if (length!==7){
                        console.log("否");
                        textcontext.font = objson[0][j].form;
                        textcontext.fillStyle=objson[0][j].color;
                        textcontext.fillText(objson[0][j].text, objson[0][j].location[0],objson[0][j].location[1]);
                    }
                }
                for(var i=0 ; i < objson[1].length ; i++){ //畫線
                    context.globalAlpha = 0.5;
                    context.lineWidth=objson[1][i].width[0]
                    context.strokeStyle = objson[1][i].color[0];
                    context.beginPath();
                    context.moveTo(objson[1][i].start[0],objson[1][i].start[1]);
                    context.lineTo(objson[1][i].end[0],objson[1][i].end[1]);
                    context.stroke();
                    context.closePath();
                }
            }

        }
</script>



<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>


