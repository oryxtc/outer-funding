var needUseProxy = ((navigator.userAgent.indexOf('Opera')>-1) || navigator.vendor == 'UCWEB' ) || location.href.indexOf('UCWeb') > 0;

function getProxyUrl(dataUrl) {
    if (needUseProxy) {
        dataUrl = '/quote2012/proxy.aspx?url=' + encodeURIComponent(dataUrl);
    }
    return dataUrl;
}

var operaMini = navigator.userAgent.indexOf('Opera')>-1 && navigator.userAgent.indexOf('Mini')>-1;

function enableHtml5() {
  if(location.href.indexOf('debug')>0)alert(operaMini);
    return (
            (!!('ontouchstart' in window))
            && document.createElement('CANVAS').getContext
            && (!operaMini)
           )
            || location.href.indexOf('html5') > 0;
}

function addEvent(elm, evType, fn, useCapture) {
    if (elm.addEventListener) {
        elm.addEventListener(evType, fn, useCapture);
        return true;
    }
    else if (elm.attachEvent) {
        var r = elm.attachEvent('on' + evType, fn);
        return r;
    }
    else {
        elm['on' + evType] = fn;
    }
}



function renderChart(dataUrl, getTimeMethod, timeOpen, timeNoon, timeClose, menuHtml, minsCount, openUrl, noonAtTimelinePosition,showTradeType) {
    var useHtml5 = enableHtml5();
    var wrapper = document.getElementById('divChartWrapper');

    if (useHtml5) {
        while (wrapper.firstChild) wrapper.removeChild(wrapper.firstChild);
        var oflash = document.getElementById('miniChart');
        if (oflash) {
            oflash.style.display = 'none';
            oflash.parentNode.removeChild(oflash);
        }
        dataUrl = getProxyUrl(dataUrl);
        if (location.href.indexOf('debug') > 0) alert('navigator.vendor=' + navigator.vendor + ',dataUrl=' + dataUrl);
        var h = ('<canvas id="canvasMCP" width="214" height="146" style="z-index: 3;"></canvas>');
        h+='\r\n<style type="text/css">';
        h+='\r\n.menu{display:none}';
        h+='\r\n.menuItem{border: 1px solid #666;color: #666666!important;display: block;font-size: 9pt;font-family: Arial,宋体;margin: 2px;text-decoration: none;line-height: 16px;text-align: center;}';
        h+='\r\n.focus{background: #FFCC66;}';
        h+='\r\n</style>';
        
        h+='\r\n<div id="canvasMCP_menu" class="menu">';
        h+=menuHtml;
        h+='</div>';
        wrapper.innerHTML = h;
        var script = document.createElement('script');
        script.type = "text/javascript";
        addEvent(script,'load',function () {
            var mcp = new MCP({
                timeOpen: timeOpen, timeNoon: timeNoon, timeClose: timeClose,showTradeType:showTradeType,
                getTimeByIndex: getTimeMethod,
                noonAtTimelinePosition:noonAtTimelinePosition||.5,
                canvasId: 'canvasMCP',
                interval: 10000,
                minsCount: minsCount,
                dataUrl: dataUrl,
                titleOptions: { left: 4, top: 0, height: 20, width: 0, paddingBottom: 4, timePaddingRight: 4 },
                contentOptions: {
                    left: 2,
                    top: 20,
                    height: 85,
                    width: 155,
                    borderColor: 'black',
                    priceLineColor: '#2358A6',
                    priceLineWidth: 1,
                    middleBorderColor: '#ff0000',
                    backgroundBorderColor: 'lightgray',
                    backgroundColor: '#ffffff',
                    onClick: function () { window.open(openUrl); }
                },
                timeAxisOptions: {
                    left: 2,
                    top: 105,
                    width: 155,
                    height: 18,
                    font: '9pt Arial',
                    fontY: 14,
                    timeOpen: '09:30',
                    timeNoon: '11:30/13:00',
                    timeClose: '15:00',
                    timeCloseRightPadding: 2
                },
                footOptions: {
                    left: 2,
                    top: 123,
                    height: 18,
                    width: 0,
                    paddingTop: 4,
                    paddingLeft: 0,
                    font: '9pt 宋体',
                    color: 'black'
                },
                customPainter: {
                    method: function (options, painter) {
                        var id = painter.canvasId + '_menu';
                        var div = $id(id);
                        var exits = (div != null);
                        if (!exits) {
                            div = document.createElement('DIV');
                            div.id = id;
                            div.className = 'menu';
                            var sections = options.sections;
                            for (var i = 0; i < sections.length; i++) {
                                var sec = sections[i];
                                var a = document.createElement('A');
                                a.innerHTML = sec.text;
                                a.href = sec.url;
                                a.className = sec.cssClass;
                                a.target = sec.target || '_blank';
                                div.appendChild(a);
                            }
                        }
                        div.style.display = 'block';
                        div.style.position = 'absolute';
                        div.style.width = options.width + 'px';
                        div.style.height = options.height + 'px';
                        div.style.left = options.left + painter.coords.x + 'px';
                        div.style.top = options.top + painter.coords.y + 'px';
                        if (!exits) document.body.appendChild(div);
                    },
                    options: {
                        left: 158,
                        top: 18,
                        width: 214 - 158,
                        height: 146 - 20 - 18,
                        sections: []
                    }
                },
                debug: false, useFakeData: false
            });
            window.mcp = mcp;
            window.mcp.paint();
        });
        script.src = 'http://data.stock.hexun.com/quote2012/libs/min.js?0117';
        document.body.appendChild(script);

        window.changeChart = function (dataUrl) {
            dataUrl = getProxyUrl(dataUrl);
            if (location.href.indexOf('debug') > 0) alert('dataUrl=' + dataUrl);
            window.mcp.updateDataUrl(dataUrl);
        };
    }
}


function aGetTimeByIndex(minIndex) {/*
    //上午09：30-11：30
    //下午13：00-15：00
    var d = new Date();
    if (minIndex <= 120) {
        d.setHours(9, 30, 30);
        d = new Date(d.getTime() + (minIndex) * 60 * 1000);
    } else {
        d.setHours(13, 0, 0);
        d = new Date(d.getTime() + (minIndex - 120) * 60 * 1000);
    }

    var hour = d.getHours() > 9 ? new String(d.getHours()) : '0' + d.getHours();
    var minutes = d.getMinutes() > 9 ? new String(d.getMinutes()) : '0' + d.getMinutes();
    var seconds = '30';
    return hour + minutes + seconds;
    */
    return getTimeByMinIndex(minIndex, 120, 9, 30, 13, 0);
}

function getTimeByMinIndex(minIndex, noonMinuteCount, startHour, startMinute, noonHour, noonMinute) {
    //var halfCount = (minsCount - minsCount % 2) / 2;
    //上午09：30-11：30
    //下午13：00-15：00
    var d = new Date();
    if (minIndex <= noonMinuteCount) {
        d.setHours(startHour, startMinute, 30);
        d = new Date(d.getTime() + (minIndex) * 60 * 1000);
    } else {
        d.setHours(noonHour, noonMinute, 0);
        d = new Date(d.getTime() + (minIndex - noonMinuteCount) * 60 * 1000);
    }

    var hour = d.getHours() > 9 ? new String(d.getHours()) : '0' + d.getHours();
    var minutes = d.getMinutes() > 9 ? new String(d.getMinutes()) : '0' + d.getMinutes();
    var seconds = '30';
    return hour + minutes + seconds;
}