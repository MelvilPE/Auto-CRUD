import os
import shutil
import SQLTemplateReader
import CRUDFilesProcessor

# Path to the SQL template file used for generating CRUD
SQL_TEMPLATE_FILENAME = "SQLTemplate.sql"

# Name of the folder containing the PHP template files
TEMPLATE_FOLDER_NAME = "template"

"""
Generates CRUD for the given table template info.

This function takes in a templateInfo dict containing the table name and params.
It first checks if a folder with the table name already exists, and removes it if so. 

It then copies the template folder to a new folder named after the table.
Finally, it will process PHP files on the new folder to rewrite parts of the CRUD template.
"""
def GenerateCRUD(templateInfo):
    tableName = templateInfo["name"]
    tableParams = templateInfo["params"]

    if os.path.isdir(tableName):
        try:
            shutil.rmtree(tableName)
        except:
            print("[GenerateCRUDS::GenerateCRUDS] failed to remove existing folder: " + tableName)
            return
    
    try:
        shutil.copytree(TEMPLATE_FOLDER_NAME, tableName)
    except:
        print("[GenerateCRUDS::GenerateCRUDS] failed to dupplicate to new folder: " + tableName)

    CRUDFilesProcessor.ProcessFiles(tableName, tableParams)

"""
Generate CRUD files for each table found in SQL template informations.
Args:
    templateInfos (list): The list of table template info dicts. 
    Each dict contains the table name and column informations.
"""
def GenerateCRUDS(templateInfos):
    for templateIndex in range(len(templateInfos)):
        GenerateCRUD(templateInfos[templateIndex])

"""
Main entry point for the CRUD file generation. 
Reads the SQL template, extracts the table informations
And generates the CRUD files for each found tables in the SQL template
"""
def Main():
    templateInfos = SQLTemplateReader.ReadSQLTemplate(SQL_TEMPLATE_FILENAME)
    GenerateCRUDS(templateInfos)

if __name__ == '__main__':
    Main()