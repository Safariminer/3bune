# \\\\\ 3BUNE
3BUNE is a fully-featured tribune complete with its bouchot and coincoin.

## Features:
3BUNE contains lots of features that you would expect in any tribune.
- Bouchot
    - Integrated customizable term blacklist
    - Standard XML backend(not complete, see "XML Backend Issues")
- Coincoin
    - Bigornophones
    - Totoz
    - Norloges

## Planned features:
As 3BUNE is neither 100% standard nor finished yet, here are some features whose implementation is planned but not yet available:
- Standard
    - Encoding
        - BML
        - SBML
    - Fun
        - Hunt
    - Security
        - Moderation
            - Plonk
    - Useful
        - Mobile version
    - No longer optional
        - lastID
        - login argument
- Non-Standard
    - Security
        - Serious
            - PGP encoding for all parties
        - Fun
            - Enigma encoding for all parties

## XML Backend Issues
The current XML backend is non-standard even though 3BUNE tries to be as strictly abiding to the standard as possible.
- BML is not a thing
- For a while, custom tag:xxxxxxxxxxxxxx--- norloges were used which are non-standard
- Even though the two main necessary endpoints are implemented(pure backend and post), the post endpoint doesn't return posts after id x when requested so.

This disparity in standard is there for 5 main reasons:
- I am lazy
- The documentation available is scattered and the main one not only has a hidden section but also doesn't include plonking nor an example of raw BML as typed by the moule
- I am lazy
- I am using PHP which is not the best language for string parsing, even though it's a pretty good language for string parsing, I'd say, but it's also the one on which I used regex for the first time in my life, and thanks to Lilymonad for showing me the way of the regex, I appreciate it
- I am lazy and would rather watch a Sam O'Nella video than crack up VS Code and write some damn PHP

## Uses:
- jQuery
- PHP 8
- This picture from Pixabay: https://pixabay.com/fr/photos/pissenlit-prairie-prairie-pissenlit-3382663/
- This picture: https://www.camptocamp.org/images/738130/fr/glacier-de-moiry-pte-de-mourti

## To-do:
### Bugs
- ~~Adding an & or a + deletes the message or overwrites an argument~~
### Bouchot
- Posting system
    - Make use of "login" arg
    - Encode BML automatically
### Coincoin
- ```frontend.php```
    - ~~Add Totoz~~
    - ~~Standard norloges~~
    - Decode BML automatically
- ```coincoin.html```
    - ~~Add Totoz manager~~ 
    - ~~Standard norloges~~
    - Implement multitribune
- General
    - Add file uploading to the tribune

## Special Thanks:
- Lily aka Lilymonad who contributed code to 3BUNE
- Aqueuse for testing
- JeCodeLeSoir for competitiveness' sake.
- Chrisix for making OLCC

```3BUNE by Safariminer | 2022-2025```
