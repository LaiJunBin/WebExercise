@echo off

set apipath=api\src\controller
set basedir=%CD%\%apipath%
set basedir=%basedir:/=\%
set file=%1
set file=%file:/=\%
set phpfile=%basedir%\%file%.php

for %%a in ("%file%") do (
   set "className=%%~NXa"
)

for /f "delims=" %%A in ("%phpfile%") do (
     set foldername=%%~dpA
)

if not exist %foldername% md %foldername%

if exist %phpfile% echo %apipath%\%file% already exists. & exit /b

echo ^<?php> %phpfile%

echo     class %className%{>> %phpfile%
echo.>> %phpfile%
echo         public function __construct(){>> %phpfile%
echo.>> %phpfile%>> %phpfile%
echo         }>> %phpfile%
echo.>> %phpfile%

echo         public function index(Request $request){>> %phpfile%
echo.>> %phpfile%
echo         }>> %phpfile%
echo.>> %phpfile%
echo         public function show(Request $request, $id){>> %phpfile%
echo.>> %phpfile%
echo         }>> %phpfile%
echo.>> %phpfile%
echo         public function create(Request $request){>> %phpfile%
echo.>> %phpfile%
echo         }>> %phpfile%
echo.>> %phpfile%
echo         public function update(Request $request, $id){>> %phpfile%
echo.>> %phpfile%
echo         }>> %phpfile%
echo.>> %phpfile%
echo         public function delete(Request $request, $id){>> %phpfile%
echo.>> %phpfile%
echo         }>> %phpfile%
echo.>> %phpfile%
echo     }>> %phpfile%

echo create api %apipath%\%file% success.