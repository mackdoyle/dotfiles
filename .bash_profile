# Test for an interactive shell. There is no need to set anything
# past this point for scp and rcp, and it's important to refrain from
# outputting anything in those cases.

# If not running interactively, don't do anything!
[[ $- != *i* ]] && return

# Aliases
# ------------------------------------------------------------
PATH=/usr/local/git/bin:$PATH

# alias for quick Directory Serice cache flushing
alias dsfc='sudo dscacheutil -flushcache'

# alias for monitoring traffic on 8080, 8082, and 33066 using tcpd
alias trace8080="sudo tcpdump -s 0 -A -i lo0 'tcp port 8080 and (((ip[2:2] - ((ip[0]&0xf)<<2)) - ((tcp[12]&0xf0)>>2)) != 0)'"
alias trace8082="sudo tcpdump -s 0 -A -i lo0 'tcp port 8082 and (((ip[2:2] - ((ip[0]&0xf)<<2)) - ((tcp[12]&0xf0)>>2)) != 0)'"
alias trace33066="sudo tcpdump -s 0 -A -i lo0 'tcp port 33066 and (((ip[2:2] - ((ip[0]&0xf)<<2)) - ((tcp[12]&0xf0)>>2)) != 0)'"


# Paths
# ------------------------------------------------------------
export PATH=$PATH:/Applications/acquia-drupal/drush

# homebrew tab completion
source `brew --prefix`/Library/Contributions/brew_bash_completion.sh

# Set Colors For Terminal
# ------------------------------------------------------------
export CLICOLOR=1 # Set CLICOLOR if you want Ansi Colors in iTerm2
export TERM=xterm-256color # Set colors to match iTerm2 Terminal Colors


BLACK=$(tput setaf 0)
RED=$(tput setaf 1)
GREEN=$(tput setaf 2)
YELLOW=$(tput setaf 3)
BLUE=$(tput setaf 4)
MAGENTA=$(tput setaf 5)
CYAN=$(tput setaf 6)
WHITE=$(tput setaf 7)
LIME_YELLOW=$(tput setaf 190)
POWDER_BLUE=$(tput setaf 153)
ORANGE=$(tput setaf 208)
GRAY=$(tput setaf 245)
BRIGHT=$(tput bold)
NORMAL=$(tput sgr0)
BLINK=$(tput blink)
REVERSE=$(tput smso)
UNDERLINE=$(tput smul)

# My Pimped Git Prompt
# ------------------------------------------------------------
source /usr/local/git/contrib/completion/git-prompt.sh
source /usr/local/git/contrib/completion/git-completion.bash

# enable git unstaged indicators - set to a non-empty value
GIT_PS1_SHOWDIRTYSTATE="."

# enable showing of untracked files - set to a non-empty value
GIT_PS1_SHOWUNTRACKEDFILES="."

# enable stash checking - set to a non-empty value
GIT_PS1_SHOWSTASHSTATE="."

# enable showing of HEAD vs its upstream
GIT_PS1_SHOWUPSTREAM="auto"

# Return the prompt prefix for the second line.
# Shows 'o' when not in a directory tracked by Git and '↓↑' when it is.
function set_prefix {
    BRANCH=`__git_ps1`
    if [[ -z $BRANCH ]]; then
        echo "${NORMAL}o"
    else
        echo "${ORANGE}↓↑"
    fi
}

# Custom prompt with Git Info, current branch, etc.
PS1='${BLUE}\u ${GRAY}in ${BLUE}\w ${GRAY}on ${MAGENTA}`__git_ps1 "%s"` ${WHITE}\r\n`set_prefix`${NORMAL} '
