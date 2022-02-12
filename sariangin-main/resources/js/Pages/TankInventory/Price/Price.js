import React from "react";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-react";
import {
  Button,
  Card,
  Col,
  Input,
  Modal,
  Popover,
  Row,
  Space,
  Table,
} from "antd";
import { Delete, EditSquare, InfoCircle } from "react-iconly";
import { routes } from "@/routes";
import { Breadcrumbs } from "@/Layouts/Components/Content/Breadcrumbs";
import { withTable } from "@/Pages/withTable";
import { currencyFormatter } from "@/Helpers/currency";

const Price = ({
  loading,
  dataSource,
  pagination,
  handleSearch,
  handleChangeTable,
}) => {
  const columns = [
    {
      title: "Kategori Tabung",
      key: "tank_category",
      sorter: true,
      render: (text, record) => record.tank_category.name,
    },
    {
      title: "Jenis Pelanggan",
      dataIndex: "customer_type",
      key: "customer_type",
      sorter: true,
    },
    {
      title: "Harga per Tabung",
      dataIndex: "price",
      key: "price",
      sorter: true,
      render: (text, record) => currencyFormatter(record.price),
    },
    {
      title: "Aksi",
      key: "actions",
      render: (text, record) => (
        <Space size="middle">
          <Popover content="Edit">
            <Link href={route(routes.PRICES_EDIT, record.id)}>
              <Button
                type="default"
                icon={
                  <EditSquare
                    size="medium"
                    set="curved"
                    className="remix-icon"
                  />
                }
              />
            </Link>
          </Popover>
          <Popover content="Delete">
            <Button
              type="primary"
              ghost
              danger
              icon={
                <Delete size="medium" set="curved" className="remix-icon" />
              }
              onClick={handleClickDelete(record.id)}
            />
          </Popover>
        </Space>
      ),
    },
  ];

  const handleClickDelete = (id) => () => {
    const data = dataSource.find((data) => data.id === id);

    Modal.confirm({
      title: "Hapus harga pengisian?",
      icon: <InfoCircle className="remix-icon" />,
      content: "Data harga pengisian ini akan dihapus secara permanen.",
      onOk: () =>
        Inertia.delete(route(routes.PRICES_DESTROY, id), {
          onSuccess: () => {
            getData();
          },
        }),
    });
  };

  return (
    <React.Fragment>
      <Row gutter={[0, 32]}>
        <Breadcrumbs breadcrumbs={[{ name: "Harga Pengisian" }]} />
        <Col span={24}>
          <Card className="da-border-color-black-40">
            <Row gutter={[0, 32]}>
              <Col span={24}>
                <h4>Harga Pengisian</h4>
                {/* <p className="da-p1-body">Master Data</p> */}
              </Col>

              <Row justify="space-between" className="da-w-100">
                <Col>
                  <Input placeholder="Search ..." onChange={handleSearch} />
                </Col>
                <Col>
                  <Button type="primary">
                    <Link href={route(routes.PRICES_CREATE)}>Create</Link>
                  </Button>
                </Col>
              </Row>

              <Col span={24}>
                <Table
                  rowKey="id"
                  columns={columns}
                  dataSource={dataSource}
                  pagination={pagination}
                  loading={loading}
                  onChange={handleChangeTable}
                />
              </Col>
            </Row>
          </Card>
        </Col>
      </Row>
    </React.Fragment>
  );
};

export default withTable(Price, {
  routeAjaxIndex: routes.PRICES_AJAX_INDEX,
});
