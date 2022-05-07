<?php

/* Markdown writing syntax
1) For headings of size 1,2,3, type #,##,### and the heading ends at newline.
For ex:
# Heading 1
2) For lists, type the list points after multiple *.
For ex:
* List item 1
* List item 2
* List item 3
3) For italics, bold, underlined text, type *text*, +text+, _text_ where 'text' is the text in between. For multiple formatting, enclose within multiple symbols.
For ex: *Hello World* gives an italicized "Hello World", *+Hello World+* gives an italicized and bold "Hello World".
4) For embedding links, type [name](link), where 'name' is the name for link appearing on the webpage and 'link' is the address of the link.
For ex:
For more information, you can click [here](https://google.com).
5) For paragraphs (text other than headings and lists), just type them with a newline.
For ex:
What a bright and sunny day. We are surely going to take a bath at the beach.
*/

function markdown_convert_to_html($input_string){
    $input_string_newlined = "\n" . $input_string . "\n";

    // Stripping whitespace
    $match = array("/ *\n */");
    $replace = array("\n");
    $input_string_stripped = preg_replace($match,$replace,$input_string_newlined);

    $match = array("/(?<=\n)#{3}(.*)(?=\n)/","/(?<=\n)#{2}(.*)(?=\n)/","/(?<=\n)#{1}(.*)(?=\n)/","/(?<=\n)(\*(.|\n)*\n)(?!\*)/U","/(?<=\n)\*(.*)\n/","/(?<=\n)([^<\n].+[^>\n])(?=\n)/","/\*(.*)\*/U","/\+(.*)\+/U","/_(.*)_/U","/\[(.+)\] *\((.+)\)/U","/<ul>\n/","/>\n/","/\n/");
    $replace = array("<h4>$1</h4>","<h3>$1</h3>","<h2>$1</h2>","<ul>\n$1</ul>\n","<li>$1</li>","<p>$1</p>","<i>$1</i>","<b>$1</b>","<u>$1</u>","<a href=\"$2\" target=\"__blank\">$1</a>","<ul>",">","<br>");#
    $output_string = preg_replace($match,$replace,$input_string_stripped);
    return substr($output_string,4);
}

function markdown_convert_to_html1($input_string){
    $input_string_newlined = "\n" . $input_string . "\n";

    // Stripping whitespace
    $match = array("/ *\n */");
    $replace = array("\n");
    $input_string_stripped = preg_replace($match,$replace,$input_string_newlined);

    #$match = array("/#{3}(.*)\n/","/#{2}(.*)\n/","/#{1}(.*)\n/","/(\*(.|\n)*)\n(?!\*)/U","/\*(.*)\n/","/(?<!(>|\n))\n(?!(<|\n))/","/\n(?!(<h|<ul))([^\n]+)(?<!ax34)\n/U","/ax34\n/","/\*(.*)\*/U","/\+(.*)\+/","/\_(.*)\_/","/\[(.*)\] *\((.*)\)/U","/>\n/","/\n/");
    #$replace = array("<h4>$1</h4>\n","<h3>$1</h3>\n","<h2>$1</h2>\n","<ul>$1\n</ul>\n","<li>$1</li>","\nax34\n","\n<p>$2</p>\n","","<i>$1</i>","<b>$1</b>","<u>$1</u>","<a href=\"$2\">$1</a>",">","<br>");
    $match = array("/#{3}(.*)\n/","/#{2}(.*)\n/","/#{1}(.*)\n/","/(\*(.|\n)*)\n(?!\*)/U","/\*(.*)\n/","/(?<!(>|\n))\n(?!(<|\n))/","/\n(?!(<h|<ul))([^\n]+)(?<!ax34)\n/U","/ax34\n/","/\*(.*)\*/U","/\+(.*)\+/","/\_(.*)\_/","/\[(.*)\] *\((.*)\)/U","/>\n/","/\n/");
    $replace = array("<h4>$1</h4>\n","<h3>$1</h3>\n","<h2>$1</h2>\n","<ul>$1\n</ul>\n","<li>$1</li>","\nax34\n","\n<p>$2</p>\n","","<i>$1</i>","<b>$1</b>","<u>$1</u>","<a href=\"$2\">$1</a>",">","<br>");
    $output_string = preg_replace($match,$replace,$input_string_stripped);
    return substr($output_string,4);
}

/*
U - non-greedy (find short instead of long matches)
1,2,3 : #{3} - 3 hashes, (.*) - All characters except newline, \n - A newline
4,5,6 : \* - Star, (.*) - All characters except newline, \* - Star
7 : \[ - Open square bracket, (.*) - All characters except newline, \] - Close square bracket, \s* - Any number of spaces, \( - Open circular bracket,
(.*) - All characters except newline, \) - Close circular bracket,
8 : \* - Star, (.|\n)* - All characters including newline, \n - A newline, (?!\*) - Not star
9 : \* - Star, (.*) - All characters except newline, \n - A newline
10 : @ - At, (.*) - All characters except newline, \n - A newline
11 : > - Close angle bracket, \n - A newline
12 : \n - A newline
*/

function markdown_convert_to_html2($input_string){
    $input_string_formatted = $input_string;
    if($input_string[-1] !== "\n"){
        $input_string_formatted = $input_string . "\n";
    }
    $match = array("/#{3}(.*)\n/","/#{2}(.*)\n/","/#{1}(.*)\n/","/\*(.*)\*/U","/\+(.*)\+/","/\_(.*)\_/","/\[(.*)\]\s*\((.*)\)/U","/(\*(.|\n)*)\n(?!\*)/U","/\*(.*)\n/","/@(.*)\n/U","/>\n/","/\n/");
    $replace = array("<h4>$1</h4>\n","<h3>$1</h3>\n","<h2>$1</h2>\n","<i>$1</i>","<b>$1</b>","<u>$1</u>","<a href=\"$2\">$1</a>","<ul>$1\n</ul>\n","<li>$1</li>","<p>$1</p>\n",">","<br>");
    return preg_replace($match,$replace,$input_string_formatted);
}

/*
U - non-greedy (find short instead of long matches)
1,2,3 : #{3} - 3 hashes, (.*) - All characters except newline, \n - A newline
4,5,6 : \* - Star, (.*) - All characters except newline, \* - Star
7 : \[ - Open square bracket, (.*) - All characters except newline, \] - Close square bracket, \s* - Any number of spaces, \( - Open circular bracket,
(.*) - All characters except newline, \) - Close circular bracket,
8 : \* - Star, (.|\n)* - All characters including newline, \n - A newline, (?!\*) - Not star
9 : \* - Star, (.*) - All characters except newline, \n - A newline
10 : @ - At, (.*) - All characters except newline, \n - A newline
11 : > - Close angle bracket, \n - A newline
12 : \n - A newline
*/


/*echo markdown_convert_to_html2("# hello
* y * li *1
hello
* *li* 2*
* l*i 3*
hello

* li 4
* li 5

## He+ading+ 2
## Heading 3
### Heading 3
head # heading 4
Hello
how are you

i am fine.
# heading 5
## heading 6
## headin#g 7

## headin#g 8
## heading 9");*/