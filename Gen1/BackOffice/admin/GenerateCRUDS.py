import os
import shutil
import SQLTemplateReader
import CRUDFilesProcessor

# Path to the SQL template file used for generating CRUD
SQL_TEMPLATE_FILENAME = "SQLTemplate.sql"

TEMPLATE_FOLDER_NAME = "template"

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

    CRUDFilesProcessor.ProcessFiles(tableName)

def GenerateCRUDS(templateInfos):
    for templateIndex in range(len(templateInfos)):
        GenerateCRUD(templateInfos[templateIndex])

def Main():
    templateInfos = SQLTemplateReader.ReadSQLTemplate(SQL_TEMPLATE_FILENAME)
    GenerateCRUDS(templateInfos)

if __name__ == '__main__':
    Main()