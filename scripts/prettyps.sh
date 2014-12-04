# get terminal width
WIDTH=`tput cols`
# pipe stdin to awk
cat | \
awk '\
BEGIN {
    # set output format
    CONVFMT="%.2f"
}
NR==1 {
    # search first line for columns that need to be converted from K to M
    for (i=1;i<=NF;i++)
        # add condition for new columns if you want
        if ($i=="VSZ" || $i=="RSS") {
            # column numbers are stored in an array
            arr[i]=i;
            $i = $i "(MB)"
        }
}
NR > 1 {
    # edit appropriate columns
    for (i in arr)
        $i=$i/1024;
}
{
    # print every line
    print $0
}' | \
# format the output into columns and trim it to terminal width
column -t | cut -c 1-$WIDTH
