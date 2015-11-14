<meta charset=utf8>
<html>
<header>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="jquery.auto-complete.js"></script>
    <script>





$('input[name="q"]').autoComplete({
    minChars: 2,
    source: function(term, suggest){
        term = term.toLowerCase();
        var choices = ['ActionScript', 'AppleScript', 'Asp'];
        var matches = [];
        for (i=0; i<choices.length; i++)
            if (~choices[i].toLowerCase().indexOf(term)) matches.push(choices[i]);
        suggest(matches);
    }
});



</script>
</header>
<body>
<input id=suka name="q">
</body>
</html>
