#!/usr/bin/perl

my $n = $ENV{CODA_LINE_ENDING};
my $source = $n;
my $quote = "'";

# Read lists
my @list;
if ($source eq $n) {
	while (<>) {
		chomp;
		s/(?:^\s+|\s+$)//g;
		push(@list,$_);
	}
} else {
	while (<>) {
		chomp;
		push(@list,split(/\s*$source\s*/));
	}
}

my $list = $quote . join("$quote$source$quote", @list) . $quote;
print "$list";
