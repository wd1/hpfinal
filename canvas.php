<canvas id="myCanvas" width="200" height="100"
style="border:1px solid #c3c3c3;">
Your browser does not support the HTML5 canvas tag.
</canvas>
<div id="captions">
    
</div>

<sub>Build with https://code.google.com/p/canvas-svg/</sub>
<p>Example by mediamaster.eu</p>
<script type="text/javascript" src='js/canvas-getsvg.js'></script>
<script type="text/javascript">
var c = document.getElementById("myCanvas");
var canvasSVGContext = new CanvasSVG.Deferred();	canvasSVGContext.wrapCanvas(c);
var canvasContext = c.getContext("2d");
function drawCanvas(ctx) {
    ctx.fillStyle = "#FF0000";
    ctx.fillRect(0,0,150,75);
}
drawCanvas(canvasContext); document.getElementById("captions").appendChild(canvasContext.getSVG());
</script>