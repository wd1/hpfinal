<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://code.highcharts.com/mapdata/custom/world-robinson-highres.js"></script>

<style type="text/css">
	#hWorld {
	    width:100%; 
	    float:right;
	}

    .placeholderimg{height:auto;}
</style>

<div id="container"></div>

<script type="text/javascript">
// Prepare demo data
// Data is joined to map using value of 'hc-key' property by default.
// See API docs for 'joinBy' for more info on linking data and map.
var data = [
    ['fo', 0],
    ['us', 1],
    ['jp', 2],
    ['in', 3],
    ['fr', 4],
    ['cn', 5],
    ['pt', 6],
    ['sw', 7],
    ['sh', 8],
    ['ec', 9],
    ['au', 10],
    ['ph', 11],
    ['es', 12],
    ['bu', 13],
    ['mv', 14],
    ['sp', 15],
    ['gb', 16],
    ['gr', 17],
    ['dk', 18],
    ['gl', 19],
    ['pr', 20],
    ['um', 21],
    ['vi', 22],
    ['ca', 23],
    ['ar', 24],
    ['cl', 25],
    ['cv', 26],
    ['dm', 27],
    ['sc', 28],
    ['jm', 29],
    ['om', 30],
    ['vc', 31],
    ['sb', 32],
    ['lc', 33],
    ['no', 34],
    ['kn', 35],
    ['bh', 36],
    ['id', 37],
    ['mu', 38],
    ['se', 39],
    ['ru', 40],
    ['tt', 41],
    ['br', 42],
    ['bs', 43],
    ['pw', 44],
    ['gd', 45],
    ['ag', 46],
    ['fj', 47],
    ['bb', 48],
    ['it', 49],
    ['mt', 50],
    ['pg', 51],
    ['vu', 52],
    ['sg', 53],
    ['cy', 54],
    ['km', 55],
    ['va', 56],
    ['sm', 57],
    ['am', 58],
    ['az', 59],
    ['tj', 60],
    ['uz', 61],
    ['ls', 62],
    ['bd', 63],
    ['kp', 64],
    ['kg', 65],
    ['mx', 66],
    ['ma', 67],
    ['co', 68],
    ['tz', 69],
    ['sa', 70],
    ['qa', 71],
    ['nl', 72],
    ['ye', 73],
    ['ae', 74],
    ['ke', 75],
    ['tr', 76],
    ['fi', 77],
    ['my', 78],
    ['pa', 79],
    ['ir', 80],
    ['ht', 81],
    ['do', 82],
    ['hr', 83],
    ['th', 84],
    ['ee', 85],
    ['cd', 86],
    ['kw', 87],
    ['de', 88],
    ['ie', 89],
    ['mm', 90],
    ['gq', 91],
    ['ug', 92],
    ['kz', 93],
    ['ga', 94],
    ['kr', 95],
    ['tl', 96],
    ['mr', 97],
    ['dz', 98],
    ['pe', 99],
    ['ao', 100],
    ['mz', 101],
    ['cr', 102],
    ['sv', 103],
    ['gt', 104],
    ['bz', 105],
    ['ve', 106],
    ['gy', 107],
    ['hn', 108],
    ['ni', 109],
    ['mw', 110],
    ['tm', 111],
    ['zm', 112],
    ['nc', 113],
    ['za', 114],
    ['lt', 115],
    ['et', 116],
    ['gh', 117],
    ['si', 118],
    ['ba', 119],
    ['jo', 120],
    ['sy', 121],
    ['mc', 122],
    ['al', 123],
    ['uy', 124],
    ['cnm', 125],
    ['mn', 126],
    ['rw', 127],
    ['bo', 128],
    ['cm', 129],
    ['cg', 130],
    ['eh', 131],
    ['rs', 132],
    ['me', 133],
    ['bj', 134],
    ['ng', 135],
    ['tg', 136],
    ['la', 137],
    ['af', 138],
    ['ua', 139],
    ['sk', 140],
    ['jk', 141],
    ['pk', 142],
    ['bg', 143],
    ['li', 144],
    ['at', 145],
    ['sz', 146],
    ['hu', 147],
    ['ne', 148],
    ['lu', 149],
    ['ad', 150],
    ['ci', 151],
    ['lr', 152],
    ['sl', 153],
    ['bn', 154],
    ['be', 155],
    ['iq', 156],
    ['ge', 157],
    ['gm', 158],
    ['ch', 159],
    ['td', 160],
    ['kv', 161],
    ['lb', 162],
    ['sx', 163],
    ['dj', 164],
    ['er', 165],
    ['bi', 166],
    ['sr', 167],
    ['il', 168],
    ['gw', 169],
    ['sn', 170],
    ['gn', 171],
    ['pl', 172],
    ['mk', 173],
    ['py', 174],
    ['by', 175],
    ['lv', 176],
    ['bf', 177],
    ['ss', 178],
    ['na', 179],
    ['ro', 180],
    ['zw', 181],
    ['kh', 182],
    ['sd', 183],
    ['cz', 184],
    ['ml', 185],
    ['bt', 186],
    ['bw', 187],
    ['md', 188],
    ['cf', 189],
    ['nz', 190],
    ['cu', 191],
    ['vn', 192],
    ['tn', 193],
    ['tw', 194],
    ['mg', 195],
    ['is', 196],
    ['lk', 197],
    ['so', 198],
    ['eg', 199],
    ['ly', 200],
    ['np', 201]
];

// Create the chart
Highcharts.mapChart('container', {
    chart: {
        map: 'custom/world-robinson-highres'
    },

    title: {
        text: 'Map Base'
    },

    subtitle: {
        text: 'Source map: <a href="http://code.highcharts.com/mapdata/custom/world-robinson.js">World, Robinson projection, medium resolution</a>'
    },

    mapNavigation: {
        enabled: true,
        buttonOptions: {
            verticalAlign: 'bottom'
        }
    },

    colorAxis: {
        min: 0
    },

    series: [{
        data: data,
        name: 'Random data',
        states: {
            hover: {
                color: '#BADA55'
            }
        },
        dataLabels: {
            enabled: true,
            format: '{point.name}'
        }
    }]
});

</script>