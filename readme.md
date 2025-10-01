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
This is only relevant if you wish to use a different front-end.

The current XML backend is non-standard even though 3BUNE tries to be as strictly abiding to the standard as possible.
- BML is not a thing
- For a while, custom tag:xxxxxxxxxxxxxx--- norloges were used which are non-standard
- Even though the two main necessary endpoints are implemented(pure backend and post), the post endpoint doesn't return posts after id x when requested so.

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
