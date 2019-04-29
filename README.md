# UNIX Authentication for Nextcloud

This backend allows local UNIX users to authenticate and use Nextcloud using
[`pwauth`](https://code.google.com/p/pwauth/).

If your Nextcloud instance is on your desktop, laptop or personal server.
You can use your PAM/UNIX credentials to log in.

## Installation

### pwauth

First install `pwauth` on your UNIX machine.

| Platform        | Instructions |
|-----------------|--------------|
| Ubuntu / Debian | `sudo apt-get install pwauth` |
| Arch Linux      | AUR: [pwauth](https://aur.archlinux.org/packages/pwauth) |

### Nextcloud

I haven't figured that out.

## Acknowledgement

This was forked from
[framagit:veretcle/user_pwauth](https://framagit.org/veretcle/user_pwauth).

It was originally licensed under the WTFPL.
