<?php
header("Content-type: multipart/x-mixed-replace;boundary=endofsection");
print "--endofsection\n";
$pmt = array("-", "\\", "|", "/" );
for( $i = 0; $i <10;$i ++ )
{
        sleep(1);
        print "Content-type: text/plain\n\n";
        print "Part $i     ".$pmt[$i % 4];
        print "--endofsection\n";
        ob_flush(); //强制将缓存区的内容输出
        flush(); //强制将缓冲区的内容发送给客户端
}
print "Content-type: text/plain\n\n";
print "The end\n";
print "–endofsection–\n";