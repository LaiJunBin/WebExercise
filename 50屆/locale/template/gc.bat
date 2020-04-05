@echo off

set dir=%1
set dir=%dir:/=\%

if %dir:~-1% == \ set dir=%dir:~0,-1%
for %%a in ("%dir%") do (
   set "filename=%%~NXa"
)

set jsfile=%dir%\%filename%.js
set htmlfile=%dir%\%filename%.html

if not exist %dir% md %dir%
if exist %jsfile% echo %jsfile% already exists. & exit /b
if exist %htmlfile% echo %htmlfile% already exists. & exit /b

echo export default { > %jsfile%
echo     data() { >> %jsfile%
echo         return { >> %jsfile%
echo. >> %jsfile%
echo         } >> %jsfile%
echo     }, >> %jsfile%
echo     mounted() { >> %jsfile%
echo         console.log('%dir:\=/%/%filename% work!'); >> %jsfile%
echo     }, >> %jsfile%
echo     methods: { >> %jsfile%
echo. >> %jsfile%
echo     } >> %jsfile%
echo } >> %jsfile%

echo ^<template^> > %htmlfile%
echo     ^<div^> >> %htmlfile%
echo         %dir%\%filename% work! >> %htmlfile%
echo     ^</div^> >> %htmlfile%
echo ^</template^> >> %htmlfile%

echo create component %dir% success.