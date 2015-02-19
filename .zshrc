# ------------------------------------------------------------
# Main config file for Zsh"#020922"
# ------------------------------------------------------------

# Path to your oh-my-zsh configuration.
# ------------------------------------------------------------
  ZSH=$HOME/.oh-my-zsh

# General
# ------------------------------------------------------------
  DISABLE_UPDATE_PROMPT=true
  COMPLETION_WAITING_DOTS=true
  DISABLE_UNTRACKED_FILES_DIRTY="true"
  export LC_ALL=en_US.UTF-8
  export LANG=en_US.UTF-8

# Theme
# ------------------------------------------------------------
  export ZSH_THEME="jmd" #jmd, half-life, remy

# Paths
# ------------------------------------------------------------

# -- Homebrew --
  # Setting this will define it before /usr/bin so duplicate installs will take precedence over default core versions
  export PATH="/usr/local/bin:$PATH"

# -- Drush --
  export PATH="$(brew --prefix drush)/bin:$PATH"

# -- Go Lang --
  #export GOVERSION="$(brew list go | head -n 1 | cut -d '/' -f 6)"
  export PATH="$PATH:/usr/local/go/bin"
  export GOPATH="$HOME/go"
  export GOBIN="$GOPATH/bin"
  export PATH="$PATH:$GOPATH:$GOBIN"

# -- Android --
  export ANDROID_HOME="/usr/local/opt/android-sdk"
  #export PATH=~/projects/android-sdk-macosx/platform-tools:~/projects/android-sdk-macosx/tools:$PATH

# -- MySQL --
  #export PATH="$(brew --prefix mysql)/bin:$PATH"

# — Node.js —
  export NODE_PATH="/usr/local/lib/node_modules"
  export PATH="$PATH:$NODE_PATH"

# -- PHP --
  # System Default Location if unset: /usr/bin/php
  #export PATH="$(brew --prefix php54)/bin:$PATH"


# -- Extended completion features for zsh.
  # If completions are failing, try rebuilding with: rm -f ~/.zcompdump; compinit
  fpath=(/usr/local/share/zsh-completions $fpath)


# Plugins
# ------------------------------------------------------------
  plugins=(command-coloring colorize color-ssh colored-man git git-extras jump brew-cask fabric extract )

# Extras
  # Add this to git_prompt_status() in git.zsh
  # if $(echo "$INDEX" | grep -E '^\?\? ' &> /dev/null); then
  #    STATUS="$ZSH_THEME_GIT_PROMPT_UNTRACKED$STATUS"
  #  fi

# -- Finally, load interactive shell
  source $ZSH/oh-my-zsh.sh


# -- Display terminal stats
echo -e "\033[0;37m`uptime | sed 's/.*up ([^,]*), .*/1/'`"

