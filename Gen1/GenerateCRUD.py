import os

# Path to the SQL template file used for generating CRUD
SQL_TEMPLATE_FILENAME = "SQLTemplate.sql"

"""
Reads the SQL template file and parses it to extract table informations.
Iterates through the lines of the SQL template file, looking for CREATE TABLE statements. 
When found, it extracts the table name, but also parameters name and type
Example: currentParam = {"name": "user_id, "type": "INT,"}
Returns a list of dicts containing the parsed table informations.
"""
def ReadSQLTemplate():
    result = []
    """
    Parses a CREATE TABLE SQL statement to extract the table name.
    Arguments:
        sqlLine (str): The CREATE TABLE SQL statement line to parse.
    Returns:
        str: The extracted table name.
    """
    def GetTableName(sqlLine):
        startTableName = sqlLine.find('TABLE') + len('TABLE')
        endTableName = sqlLine.find('(', startTableName)
        finalTableName = sqlLine[startTableName:endTableName].strip()
        return finalTableName
    
    """
    Parses the lines between a CREATE TABLE statement to extract the column informations.
    Iterates through the lines after the CREATE TABLE, until reaching the end ");". 
    Strips each line and appends to a list to return.

    Used to extract column informations from a CREATE TABLE statement.
    """
    def GetEachLinesBetweenTable(sqlContent, sqlLineIndex):
        tableContent = []
        for nextSqlLineIndex in range(sqlLineIndex + 1, len(sqlContent)):
            nextSqlLine = sqlContent[nextSqlLineIndex]
            if ");" in nextSqlLine:
                break
            tableContent.append(nextSqlLine.strip())
        return tableContent
    
    """
    Parses the column informations to extract the column names and data types.
    
    Iterates through the column definition lines, skipping PRIMARY KEY 
    and FOREIGN KEY definitions. Splits each line to get the column
    name and data type. 
    
    Returns a list of dicts containing the column name and data type.
    """
    def GetEachParameters(tableLines):
        tableParameters = []
        for sqlParamLine in tableLines:
            if "PRIMARY KEY" in sqlParamLine:
                continue
            if "FOREIGN KEY" in sqlParamLine:
                continue

            paramName = sqlParamLine.split()[0]
            paramType = sqlParamLine.split()[1]

            currentParam = {
                "name": paramName,
                "type": paramType
            }

            tableParameters.append(currentParam)
        return tableParameters

    sqlContent = []
    with open(SQL_TEMPLATE_FILENAME, "r") as sqlFile:
        sqlContent = sqlFile.readlines()
            
    # We will process each found table
    for sqlLineIndex in range(len(sqlContent)):
        sqlLine = sqlContent[sqlLineIndex]
        if "CREATE TABLE" not in sqlLine:
            continue

        tableName = GetTableName(sqlLine)
        tableLines = GetEachLinesBetweenTable(sqlContent, sqlLineIndex)
        tableParams = GetEachParameters(tableLines)
        
        tableResult = {
            "name": tableName,
            "params": tableParams
        }

        result.append(tableResult)
    return result

def Main():
    sqlResult = ReadSQLTemplate()

    print(sqlResult)


if __name__ == '__main__':
    Main()